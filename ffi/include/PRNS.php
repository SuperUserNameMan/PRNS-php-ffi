<?php

PRNS::PRNS(); // autoinit

// seekable random-access pseudo-random numbers generator
// PRNS is 64 bits
// LPRNS is 32 bits

class PRNS
{
	//----------------------------------------------------------------------------------
	// FFI initialisation
	//----------------------------------------------------------------------------------

	public static $ffi;

	public static $ffi_type_prns ;
	public static $ffi_type_lprns ;

	public static function PRNS() : void
	{
		if ( static::$ffi ) 
		{ 
			debug_print_backtrace();
			exit("PRNS::PRNS() already init".PHP_EOL); 
		}
		
		$cdef = __DIR__ . '/PRNS.ffi.php.h';
		
		$lib_dir = defined('FFI_LIB_DIR') ? FFI_LIB_DIR : 'lib' ;
		
		$slib = "./$lib_dir/libPRNS.".PHP_SHLIB_SUFFIX;
		
		static::$ffi = FFI::cdef( file_get_contents( $cdef ) , $slib );

		static::$ffi_type_prns = static::$ffi->type('prns_t');
		static::$ffi_type_lprns = static::$ffi->type('lprns_t');
	}

	//----------------------------------------------------------------------------------
	// FFI callback
	//----------------------------------------------------------------------------------

	public static function __callStatic( string $method , array $args ) : mixed
	{
		$callable = [static::$ffi, 'PRNS_'.$method];
		return $callable(...$args);
	}

	//----------------------------------------------------------------------------------
	// Helpers
	//----------------------------------------------------------------------------------

	public static function New( int $seed = 0 ) : object
	{
		$gen = static::$ffi->new( static::$ffi_type_prns );
		static::$ffi->PRNS_Set( FFI::addr( $gen ) , $seed );

		return $gen ;
	}

	public static function Set( object $gen , int $pos ) : void
	{
		static::$ffi->PRNS_Set( FFI::addr( $gen ) , $pos );
	}

	public static function Seek( object $gen , int $offset ) : void
	{
		static::$ffi->PRNS_Seek( FFI::addr( $gen ) , $offset );
	}

	public static function Tell( object $gen ) : int
	{
		return static::$ffi->PRNS_Tell( FFI::addr( $gen) );
	}

	public static function Peek( object $gen ) : int
	{
		return static::$ffi->PRNS_Peek( FFI::addr( $gen ) );
	}

	public static function Next( object $gen ) : int
	{
		return static::$ffi->PRNS_Next( FFI::addr( $gen ) );
	}

	public static function Prev( object $gen ) : int
	{
		return static::$ffi->PRNS_Prev( FFI::addr( $gen ) );
	}


};

class LPRNS
{
	//----------------------------------------------------------------------------------
	// FFI callback
	//----------------------------------------------------------------------------------

	public static function __callStatic( string $method , array $args ) : mixed
	{
		$callable = [PRNS::$ffi, 'LPRNS_'.$method];
		return $callable(...$args);
	}

	//----------------------------------------------------------------------------------
	// Helpers
	//----------------------------------------------------------------------------------

	public static function New( int $seed = 0 ) : object
	{
		$gen = static::$ffi->new( static::$ffi_type_lprns );
		static::$ffi->LPRNS_Set( FFI::addr( $gen ) , $seed );

		return $gen ;
	}

	public static function Set( object $gen , int $pos ) : void
	{
		static::$ffi->LPRNS_Set( FFI::addr( $gen ) , $pos );
	}

	public static function Seek( object $gen , int $offset ) : void
	{
		static::$ffi->LPRNS_Seek( FFI::addr( $gen ) , $offset );
	}

	public static function Tell( object $gen ) : int
	{
		return static::$ffi->LPRNS_Tell( FFI::addr( $gen ) );
	}

	public static function Peek( object $gen ) : int
	{
		return static::$ffi->LPRNS_Peek( FFI::addr( $gen ) );
	}

	public static function Next( object $gen ) : int
	{
		return static::$ffi->LPRNS_Next( FFI::addr( $gen ) );
	}

	public static function Prev( object $gen ) : int
	{
		return static::$ffi->LPRNS_Prev( FFI::addr( $gen ) );
	}

};

// EOF

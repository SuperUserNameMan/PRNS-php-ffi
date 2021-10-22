# PRNS-php-ffi
php8 ffi binding to PRNS (Random Access Pseudo Random Generator)


## PRNS

PRNS is a public domain "Random Access Pseudo Random Generator" by [Marc-b-Reynolds](https://github.com/Marc-B-Reynolds).

This PRNG differs from others by the fact that it can be used like if it was a random-access stream of data.

Here is the officiel documentation : http://marc-b-reynolds.github.io/shf/2016/04/19/prns.html

There are two versions of this algorithm :
- [prns (64 bits)](https://github.com/Marc-B-Reynolds/Stand-alone-junk/tree/master/src/SFH/prns.h)
- [lprns (32 bits)](https://github.com/Marc-B-Reynolds/Stand-alone-junk/tree/master/src/SFH/lprns.h)

This binding includes them both into a shared library.

## Compiling libPRNS library :

````C
#include <inttypes.h>
#include <math.h>

#include "prns.h"
#include "lprns.h"

// 64 bits API :

uint64_t PRNS_At  ( uint64_t  n ) { return prns_at( n ); }
				
uint64_t PRNS_Tell( prns_t* gen ) { return prns_tell( gen ); }
void     PRNS_Set ( prns_t* gen , uint64_t pos   ) { prns_set ( gen , pos ); }
void     PRNS_Seek( prns_t* gen , int64_t offset ) { prns_seek( gen , offset ); }

uint64_t PRNS_Peek( prns_t* gen ) { return prns_peek( gen ); }
uint64_t PRNS_Next( prns_t* gen ) { return prns_next( gen ); }
uint64_t PRNS_Prev( prns_t* gen ) { return prns_prev( gen ); }

// 32 bits API :

uint32_t LPRNS_At  ( uint32_t   n ) { return lprns_at( n ); }

uint32_t LPRNS_Tell( lprns_t* gen ) { return lprns_tell( gen ); }
void     LPRNS_Set ( lprns_t* gen , uint32_t pos   ) { lprns_set ( gen , pos ); }
void     LPRNS_Seek( lprns_t* gen , int32_t offset ) { lprns_seek( gen , offset ); }

uint32_t LPRNS_Peek( lprns_t* gen ) { return lprns_peek( gen ); }
uint32_t LPRNS_Next( lprns_t* gen ) { return lprns_next( gen ); }
uint32_t LPRNS_Prev( lprns_t* gen ) { return lprns_prev( gen ); }

````

Then  :

````
gcc -c -O2 -fpic libPRNS.c
gcc -shared -o libPRNS$LIB_EXT libPRNS.o
````


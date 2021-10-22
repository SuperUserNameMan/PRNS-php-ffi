

typedef struct { uint64_t i; } prns_t;

uint64_t PRNS_Tell( prns_t* gen );
void     PRNS_Set ( prns_t* gen , uint64_t pos   );
void     PRNS_Seek( prns_t* gen , int64_t offset );

uint64_t PRNS_At  ( uint64_t  n );
uint64_t PRNS_Peek( prns_t* gen );
uint64_t PRNS_Next( prns_t* gen );
uint64_t PRNS_Prev( prns_t* gen );



typedef struct { uint32_t i; } lprns_t;

uint32_t LPRNS_Tell( lprns_t* gen );
void     LPRNS_Set ( lprns_t* gen , uint32_t pos   );
void     LPRNS_Seek( lprns_t* gen , int32_t offset );

uint32_t LPRNS_At  ( uint32_t  n );
uint32_t LPRNS_Peek( lprns_t* gen );
uint32_t LPRNS_Next( lprns_t* gen );
uint32_t LPRNS_Prev( lprns_t* gen );

create table PART
(
	P_PARTKEY integer,
	P_NAME varchar(55),
	P_MFGR char(25),
	P_BRAND char(10),
	P_TYPE varchar(25),
	P_SIZE integer,
	P_CONTAINER char(10),
	P_RETAILPRICE Decimal,
	P_COMMENT varchar(23),
	primary key (P_PARTKEY)
);

create table REGION
(
	R_REGIONKEY integer,
	R_NAME char(25),
	R_COMMENT varchar(152),
	Primary Key (R_REGIONKEY)
);

create table NATION
(	
	N_NATIONKEY integer,
	N_NAME char(25),
	N_REGIONKEY integer references REGION(R_REGIONKEY),
	N_COMMENT varchar(152),
	Primary Key (N_NATIONKEY)
);

create table SUPPLIER
(
	S_SUPPKEY integer,
	S_NAME char(25),
	S_ADDRESS varchar(40),
	S_NATIONKEY integer references NATION(N_NATIONKEY),
	S_PHONE char(15),
	S_ACCTBAL Decimal,
	S_COMMENT varchar(101),
	Primary Key (S_SUPPKEY)
);

create table PARTSUPP
(
	PS_PARTKEY integer references PART(P_PARTKEY),
	PS_SUPPKEY integer references SUPPLIER(S_SUPPKEY),
	PS_AVAILQTY integer,
	PS_SUPPLYCOST Decimal,
	PS_COMMENT varchar(199),
	Primary Key (PS_PARTKEY, PS_SUPPKEY)
);

create table CUSTOMER
(
	C_CUSTKEY integer,
	C_NAME varchar(25),
	C_ADDRESS varchar(40),
	C_NATIONKEY integer references NATION(N_NATIONKEY),
	C_PHONE char(15),
	C_ACCTBAL Decimal,
	C_MKTSEGMENT char(10),
	C_COMMENT varchar(117),
	Primary Key (C_CUSTKEY)
);

create table ORDERS
(
	O_ORDERKEY integer,
	O_CUSTKEY integer references CUSTOMER(C_CUSTKEY),
	O_ORDERSTATUS char(1),
	O_TOTALPRICE Decimal,
	O_ORDERDATE Date,
	O_ORDERPRIORITY char(15),
	O_CLERK char(15),
	O_SHIPPRIORITY Integer,
	O_COMMENT varchar(79),
	Primary Key (O_ORDERKEY)
);

create table LINEITEM
(
	L_ORDERKEY integer references ORDERS(O_ORDERKEY),
	L_PARTKEY integer,
	L_SUPPKEY integer,
	L_LINENUMBER integer,
	L_QUANTITY decimal,
	L_EXTENDEDPRICE decimal,
	L_DISCOUNT decimal,
	L_TAX decimal,
	L_RETURNFLAG char(1),
	L_LINESTATUS char(1),
	L_SHIPDATE date,
	L_COMMITDATE date,
	L_RECEIPTDATE date,
	L_SHIPINSTRUCT char(25),
	L_SHIPMODE char(10),
	L_COMMENT varchar(44),
	Foreign Key (L_PARTKEY, L_SUPPKEY) references PARTSUPP(PS_PARTKEY, PS_SUPPKEY),
	Primary Key (L_ORDERKEY, L_LINENUMBER)
);

# need to use absolute path for the following files

COPY PART FROM '/home/j/Downloads/DB/raw/part.tbl' WITH DELIMITER '|';
COPY REGION FROM '/home/j/Downloads/DB/raw/region.tbl' WITH DELIMITER '|';
COPY NATION FROM '/home/j/Downloads/DB/raw/nation.tbl' WITH DELIMITER '|';
COPY SUPPLIER FROM '/home/j/Downloads/DB/raw/supplier.tbl' WITH DELIMITER '|';
COPY PARTSUPP FROM '/home/j/Downloads/DB/raw/partsupp.tbl' WITH DELIMITER '|';
COPY CUSTOMER FROM '/home/j/Downloads/DB/raw/customer.tbl' WITH DELIMITER '|';
COPY ORDERS FROM '/home/j/Downloads/DB/raw/orders.tbl' WITH DELIMITER '|';
COPY LINEITEM FROM '/home/j/Downloads/DB/raw/lineitem.tbl' WITH DELIMITER '|';


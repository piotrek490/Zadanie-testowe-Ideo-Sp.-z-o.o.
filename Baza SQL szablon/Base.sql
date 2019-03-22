drop database HaszSet;

create database HaszSet DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

use HaszSet;

create table MainTableData(
val int(20),
valNext int(20),
dataKey text,
isFirst int(1)
)CHARSET=utf8;




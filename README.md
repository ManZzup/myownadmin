my own Admin
============

**What is my own Admin (moA) ?**


A highly portable, simplified content administration system. It's like a super tiny Content Management System (CMS) yet
intergrated seperately from your primary application / website

**So this is another CMS?**

NO, this doesn't provide any kinda service or feature of a standard CMS

**Then what does it give?**

It gives a higly customizable class which can change its form dynamically to represent any object you need
ex: It can represent a Post in your page
    Better; it can represent Page in your site
    Even better; it can represent your SITE !!
    
Yet, all of them are optional, you can control its behaviour 100%

**What are the mandatory files for the system?**

Only moa.php and config.php

**How to use those?**

Let's start


Usage
=====

1) Download all above files
2) post.php is a script written to give a moA object a 'Post' like behaviour. It means once you include the post.php,
you can easily add, delete, update or retrieve Posts from your database.
3) Post is only a moO (my own Object) that can be adapted dynamically to represent many real world application such as post in a site, a web page, a user etc.
4) Change the config.php variables to suit your database requirement
NOTE: you can also replace the query methods in the file since all the queries done by moA objects process through them :) <- PORTABILITY

moA classes
-----------

moA (my own Admin) class  : the main system where all action happens
moO (my own Object) class : an abstract class which can represent anything, this is used to keep track of objects by moA 

moA default methods
-------------------

```php
constructor($table,$cfg,$primary)
```


$table	: the name of the table to which record manipulation should be done
$cfg 	  : an array resenting the class variables => table fields
	  ex: 
	  Let's assume our table structure to be
	  
```
	  +--------+-----------+------+-----+-------------------+----------------+
		| Field  | Type      | Null | Key | Default           | Extra          |
		+--------+-----------+------+-----+-------------------+----------------+
		| ID     | int(11)   | NO   | PRI | NULL              | auto_increment |
		| Title  | longtext  | NO   |     | NULL              |                |
		| Post   | longtext  | NO   |     | NULL              |                |
		| Parent | int(11)   | NO   |     | NULL              |                |
		| Dtime  | timestamp | NO   |     | CURRENT_TIMESTAMP |                |
		+--------+-----------+------+-----+-------------------+----------------+
```
	our config can be defined as 
	
```php
	$cfg = array(
                'pid' => 'ID',
                'title' => 'Title',
                'post' => 'Post',
                'parent' => 'Parent',
                'dtime' =>  'Dtime'        
            );
```
            
        NOTE: Array keys are what you would like to call them in an object. You are free to relace them but array values should be exactly matching to those field of the given table
        like $post->title, $post->pid

$primary : primary key of the table, this will be the unique identification of the object


```php
init($params)
```

Method that would put actual values to the instance properties of moO

$params	: array consisting of the keys defined in $cfg as keys and the values to put in table as values of the array
	  ex: we can initialize a demo post as
```php
	  $params = array(
                'title' => 'My new Title',
                'post' => 'These are the post content',
                'parent' => '0'        
            );
```  
            NOTE: you can leave out any field that you donot want to initialize like ID, Date

```php        
add($moo)
```
Add a record to the table correspoding to the given moO object

$moo 	: moO Object

```php
getAll()
```

Return an array of moO objects corresponding to all the records in the table

```php
getByField($field,$value)
```

Return an array of moO objects [or a single moO object is only 1 record is found]

$field	: table field to match a property
$value	: value to be matched

```php
delete($moo)
```
Delete the table record corresponding to the given $moo object

$moo	: moO Object

```php
deleteByField($field,$value)
```
Delete all the table records corresponding to the given field/value pair

```php
update($moo)
```
Update the record corresponding to the $moo objects with the changed values

$moo	: moO Object




<?php
/**
 * Created by PhpStorm.
 * User: prios
 * Date: 2/19/19
 * Time: 8:48 PM
 */

require_once '../AppCode/Models/Category.php';

$category = new Category();
$category->name = 'Electronics';
$category->unit = null;
$category->bulkUnit = null;

$size = new Attribute();
$size->name = 'size';
$size->required = true;
$size->unit = 'inch';
$size->bulkUnit = null;
$size->type = 'string';

$features = new Attribute();
$features->name = 'features';
$features->required = true;
$features->unit = null;
$features->bulkUnit = null;
$features->type='list';

$warranty = new Attribute();
$warranty->name = 'warranty';
$warranty->required = true;
$warranty->unit = 'months';
$warranty->bulkUnit = 'years';
$warranty->type='number';

$category->attributes = [$size,$features,$warranty];

echo(Category::store($category));

$category = new Category();
$category->name = 'Clothes';
$category->unit = null;
$category->bulkUnit = null;

$size = new Attribute();
$size->name = 'size';
$size->required = true;
$size->unit = null;
$size->bulkUnit = null;
$size->type = 'select';
$size->supportedValues = ['XL','XXL'];

$gender = new Attribute();
$gender->name = 'gender';
$gender->required = true;
$gender->unit = null;
$gender->bulkUnit = null;
$gender->type = 'select';
$gender->supportedValues = ['Male','Female'];

$ageGroup = new Attribute();
$ageGroup->name = 'ageGroup';
$ageGroup->required = true;
$ageGroup->unit = null;
$ageGroup->bulkUnit = null;
$ageGroup->type = 'select';
$ageGroup->supportedValues = ['Children','Adult'];

$features = new Attribute();
$features->name = 'features';
$features->required = true;
$features->unit = null;
$features->bulkUnit = null;
$features->type='list';

$category->attributes = [$size,$features,$gender,$ageGroup];

die(Category::store($category));
<?php
namespace App\Database;

interface QueryBuilder
{
	public function insert(string $table, bool $all);

	public function select(array $fields);

	public function update(string $table);

	public function delete(string $table);

	public function from(string $table, string $alias);

	public function as(string $alias);

	public function fields(array $fields);

	public function distinct(string $field, string $alias);

	public function where(string $field, string $operator, string $value);

	public function count(string $field, string $alias);

	public function min(string $field, string $alias);

	public function max(string $field, string $alias);

	public function avg(string $field, string $alias);

	public function sum(string $field, string $alias);

	public function and(string $field, string $operator, string $value);

	public function or(string $field, string $operator, string $value);

	public function not(string $field, string $operator, string $value);

	public function between($min, $max);

	public function in(array $values);

	public function notIn(array $values);

	public function like(string $value);

	public function condition(string $condition);

	public function join(string $table, string $alias);

	public function leftjoin(string $table, string $alias);

	public function rightjoin(string $table, string $alias);

	public function naturaljoin(string $table, string $alias);

	public function using(string $field);

	public function on(string $field1, string $field2);

	public function order(string $field, string $order);

	public function group(array $fields);
}
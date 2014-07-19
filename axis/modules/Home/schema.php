<?php
/**
 * Module Database Schema
 *
 * Used for Module Installation/Uninstallation/Updates
 *
 * Explaination:
 *
 * @code
 * // Create a table
 * // Individual array for each table you would like to create
 * $schema[$version]['create']['table'][$tableName] = [
 *     [
 *         'column' => [
 *             'name' => $columnName,
 *             'type' => $columnType,
 *             'not_null' => '1' or leave blank to allow null,
 *             'unsigned' => '1' or leave blank to allow unsigned numeric types,
 *             'autoincrement' => '1' or leave blank for no autoincrement,
 *             'default' => $defaultValue or leave blank for no default value,
 *         ],
 *     ],
 * ];
 *
 * // Insert data into tables
 * // A single array of table names and their colum/value pairs for all data inserts
 * $schema['0.01']['insert']['table'] = [
 *     [
 *         'ciao_data' => [
 *             [
 *                 $columnName => $columnValue,
 *                 $columnName => $columnValue,
 *                 $columnName => $columnValue,
 *                 $columnName => $columnValue
 *             ],
 *         ],
 *     ],
 * ];
 * @endcode
 */

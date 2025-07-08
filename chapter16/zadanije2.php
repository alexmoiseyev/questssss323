<?php
// ЗАДАНИЕ 2 //
file_put_contents('test1.txt', 'test');


mkdir('test');
chdir('test');


file_put_contents('test2.txt', 'test');

chdir('../..');

file_put_contents('test3.txt', 'test');

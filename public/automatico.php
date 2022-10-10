<?php

namespace automatico;

use \core\murano\DB;

DB::table('teste')->insert([
    'nome' => rand(0, 9990)
])->execute();

echo 'talvez foi';

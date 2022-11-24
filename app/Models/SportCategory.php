<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportCategory extends Model
{
    use HasFactory;
    protected $table = 'sport_category';
    protected $fillable = [
        'title',
        'description',
        'image', 
        'status'
    ];
    public function readInputFromFile($file)
    {
        $fh = fopen($file, 'rb');
        while (!feof($fh)) {
            $ln = fgets($fh);
            $parts[] = $ln;
        }
        fclose($fh);
        return $parts;
    }
}

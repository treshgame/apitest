<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *  definition="Note",
 *  @SWG\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="full_name",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="company",
 *      type="string"
 *  )
 * @SWG\Property(
 *      property="phone_number",
 *      type="string"
 *  )
 * @SWG\Property(
 *      property="email",
 *      type="string"
 *  )
 * @SWG\Property(
 *      property="birthday",
 *      type="string"
 *  )
 * @SWG\Property(
 *      property="photo",
 *      type="string"
 *  )
 * )
 */
class Note extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'full_name',
        'company',
        'phone_number',
        'email',
        'birthday',
        'photo'
    ];
}

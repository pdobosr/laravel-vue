<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Contact extends BaseModel
{
    protected $fillable = ['name', 'number'];

    public function __construct()
    {
        parent::__construct(self::class, ['name', 'number']);
    }

    /**
     * @return BelongsToMany
     */
    public function shippers(): BelongsToMany
    {
        return $this->belongsToMany(Shipper::class, 'shipper_contact');
    }
}

<?php

namespace App\Model;

class Shipper extends BaseModel
{
    public function __construct()
    {
        parent::__construct(self::class, ['address', 'company_name', 'primary_contact_id']);
    }

    public function contacts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Contact::class, 'shipper_contact');
    }

    public function primaryContact(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}

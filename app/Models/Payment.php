<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // تحديد الجدول المرتبط بالنموذج
    protected $table = 'payments';

    // الحقول القابلة للتعديل
    protected $fillable = [
        'person_id',  // يربط الدفع بالشخص الذي تلقى الدفع
        'amount',     // المبلغ المدفوع
        'payment_date', // تاريخ الدفع
    ];

    // العلاقات (إن كانت هناك علاقات)
    public function person()
    {
        return $this->belongsTo(people::class, 'person_id');
    }
}

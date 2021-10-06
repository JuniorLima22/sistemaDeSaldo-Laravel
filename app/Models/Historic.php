<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
    protected $fillable = ['type', 'amount', 'total_before', 'total_after', 'user_id_transaction', 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userSender()
    {
        return $this->belongsTo(User::class, 'user_id_transaction');
    }
    
    public function getDateAttribute($value)
    {
         return Carbon::parse($value)->format('d/m/Y');
    }

    public function type($type = null)
    {
        $types = [
            'I' => 'Recarga',
            'O' => 'Saque',
            'T' => 'Transferência',
        ];

        if (!$type) {
            return $types;
        }

        if ($this->user_id_transaction != null && $type == 'I') {
            return 'Recebido';
        }

        return $types[$type];
    }

    public function search(Array $data, $totalPage)
    {
        $historics = $this->where(function ($query) use ($data) {
            if (isset($data['id'])) {
                $query->where('id', $data['id']);
            }

            if (isset($data['date'])) {
                $query->where('date', $data['date']);
            }

            if (isset($data['type'])) {
                $query->where('type', $data['type']);
            }
            
        })->paginate($totalPage);
        
        return $historics;
    }    
}

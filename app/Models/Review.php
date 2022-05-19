<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Review extends Model
{
    protected $fillable = ['sku_id','text','grade','author_name','attachments','active'];

    public function sku() {
        return $this->belongsTo(Sku::class);
    }

    public function scopeGetActive($query) {
        return $query->where('active','1');
    }

    public function getAttachmentsAttribute($value)
    {
        $photoMimeTypes = ['image/jpeg','image/png','image/bmp'];
        $attachments = unserialize($value);
        $attachmentsArray = [];
        $i = 0;
        foreach($attachments as $attachment) {
            $attachmentsArray[$i]['path'] = Storage::url($attachment);
            if(in_array(Storage::mimeType($attachment),$photoMimeTypes))
                $attachmentsArray[$i]['isPhoto'] = true;
            else
                $attachmentsArray[$i]['isPhoto'] = false;
            $attachmentsArray[$i]['mimeType'] = Storage::mimeType($attachment);
            $i++;
        }
        return $attachmentsArray;
    }

    public function getProductNameAttribute() {
        return Product::where('id',$this->sku->product->id)->first()->__('name');
    }

    use HasFactory;
}

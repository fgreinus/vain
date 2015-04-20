<?php namespace Modules\Chartrans\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Request extends Model {

    protected $table = 'chartrans_requests';

    const STATE_DECLINED        = -1;
    const STATE_STEP_ONE        = 1;
    const STATE_STEP_TWO        = 2;
    const STATE_STEP_THREE      = 3;
    const STATE_STEP_FOUR       = 4;
    const STATE_STEP_FIVE       = 5;
    const STATE_SUBMITTED       = 100;
    const STATE_IN_REVIEW       = 101;
    const STATE_ACCEPTED        = 102;
    const STATE_COMPLETE        = 103;

    const SOURCE_SERVER_TYPE_PRIVATE    = 0;
    const SOURCE_SERVER_TYPE_OFFICIAL   = 1;

    protected $fillable = [
        'state',

        'destination_realm', 'destination_account_id', 'destination_character_race', 'destination_character_class',
        'destination_character_equipment', 'destination_character_profession',

        'source_server_website', 'source_server_realm', 'source_server_expansion', 'source_server_account',
        'source_server_character', 'source_server_account_characters', 'source_server_type'
    ];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('Modules\User\Entities\User');
    }
}
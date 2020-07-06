<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{

    const STATE_ACTIVE = 1;

    const STATE_INACTIVE = 2;

    const STATE_DELETED = 3;

    const IS_READ_NO = 0;

    const IS_READ_YES = 1;
    
    const TYPE_TEXT_MESSAGE = 1;
    
    const TYPE_MEDIA_FILE = 2;

    public function __construct($type = 'chat_message')
    {
        parent::__construct();

        $this->setTable($type);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message',
        'group_id',
        'state_id',
        'type_id',
        'to_user_id',
        'from_user_id'
    ];

    public function asCustomJson()
    {
        $json = [];
        $json['id'] = $this->id;
        $json['icon'] = '';
        $json['message'] = $this->message;
        $json['from_id'] = $this->from_user_id;
        $json['to_id'] = $this->to_user_id;
        $json['group_id'] = $this->group_id;
        $json['created_on'] =  date('d F Y h:i:s', strtotime($this->created_at));
        $json['is_read'] = $this->is_read;
        $json['state_id'] = $this->state_id;
        $json['from_user_profile_file'] = '';
        $json['to_user_profile_file'] = '';
        $json['type_id'] = $this->type_id;
        return $json;
    }
}

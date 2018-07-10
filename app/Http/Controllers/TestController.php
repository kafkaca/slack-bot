<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class TestController extends Controller
{

     public function carbon()
    {
        $now = Carbon::now();
        //echo $now->addDays(29);
        $columns = \DB::connection()->getSchemaBuilder()->getColumnListing('departments');
        //return $columns;
        
        return auth()->user()->employee()->first()->append([
            'calisilan_gun',
            'kac_gun_kaldi',
            'kullanilan_izin',
            'vacations',
            'department',
        ])->vacations()->get();
        
        //\App\Department::find(1)
        //->CheckIsBlockDateCount('2018-05-01', '2018-11-29')->get();
        //\App\Employee::find(1)->vacations()->create(request()->all());
       // return \App\Employee::create(request()->all());
        /*\App\Employee::find(1)->first()
            ->append([
                'calisilan_gun',
                'kac_gun_kaldi',
                'kullanilan_izin',
                'vacations',
                'department',
            ]);
*/
        /*
        ::whereHas('comments', function ($query) {
        $query->where('content', 'like', 'foo%');
        })->get();
         */
        //\App\Department::find(2)->employees()->has('vacations')->get();
        //\App\Employee::find(1)->department()->first()->employees()->select('id')->get()->pluck('id');
        //->department();
        //->first()->employess()->get();

        //auth()->user()->roles()->sync((array) [2], true);

        return $current->diffInDays($izin_baslangic);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Undocumented function
     *
     * @param [type] $table_name
     * @return void
     */
    public function getTableColumns($table_name)
    {
    $columns =  \DB::connection()->getSchemaBuilder()->getColumnListing($table_name);
    return $columns;
    }

    /**
     * Slack IncomeApi Test."
     *
     * @return void
     */
    public function incomeApi()
    {
        $slack_token = "xoxp-220065738711-218966452658-393082834003-4ef995ade6442eb94d49fac58fc3d6e2";
        $get_content = file_get_contents("https://slack.com/api/users.info?token=" . $slack_token . "&user=U6EUEDAKC&pretty=1");
        return response()->json(json_decode($get_content));
    }

    /**
     * Curl Test Slack.
     *
     * @return void
     */
    public function slack_curl()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://hooks.slack.com/services/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",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\r\n    \"text\": \"Would you like to play a game?\",\r\n    \"response_type\": \"in_channel\",\r\n    \"attachments\": [\r\n        {\r\n            \"text\": \"Choose a game to play\",\r\n            \"fallback\": \"If you could read this message, youd be choosing something fun to do right now.\",\r\n            \"color\": \"#3AA3E3\",\r\n            \"attachment_type\": \"default\",\r\n            \"callback_id\": \"game_selection\",\r\n            \"actions\": [\r\n                {\r\n                    \"name\": \"games_list\",\r\n                    \"text\": \"Pick a game...\",\r\n                    \"type\": \"select\",\r\n                    \"options\": [\r\n                        {\r\n                            \"text\": \"Hearts\",\r\n                            \"value\": \"hearts\"\r\n                        },\r\n                        {\r\n                            \"text\": \"Bridge\",\r\n                            \"value\": \"bridge\"\r\n                        },\r\n                        {\r\n                            \"text\": \"Checkers\",\r\n                            \"value\": \"checkers\"\r\n                        },\r\n                        {\r\n                            \"text\": \"Chess\",\r\n                            \"value\": \"chess\"\r\n                        },\r\n                        {\r\n                            \"text\": \"Poker\",\r\n                            \"value\": \"poker\"\r\n                        },\r\n                        {\r\n                            \"text\": \"Falkens Maze\",\r\n                            \"value\": \"maze\"\r\n                        },\r\n                        {\r\n                            \"text\": \"Global Thermonuclear War\",\r\n                            \"value\": \"war\"\r\n                        }\r\n                    ]\r\n                }\r\n            ]\r\n        }\r\n    ]\r\n}",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 91a3c8a6-784e-8827-4adb-5b5f842d7aa2",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }

    }

    /**
     * Send formatted json data to Slack
     *
     * @return void
     */
    public function json_sender()
    {
        $json_to = '{
    "attachments": [
        {
            "fallback": "Required plain-text summary of the attachment.",
            "color": "#36a64f",
            "pretext": "Optional text that appears above the attachment block",
            "author_name": "Bobby Tables",
            "author_link": "http://flickr.com/bobby/",
            "author_icon": "http://flickr.com/icons/bobby.jpg",
            "title": "Slack API Documentation",
            "title_link": "https://api.slack.com/",
            "text": "Optional text that appears within the attachment",
            "fields": [
                {
                    "title": "Priority",
                    "value": "High",
                    "short": false
                }
            ],
            "image_url": "http://my-website.com/path/to/image.jpg",
            "thumb_url": "http://example.com/path/to/thumb.png",
            "footer": "Slack API",
            "footer_icon": "https://platform.slack-edge.com/img/default_application_icon.png",
            "ts": 123456789
        }
    ]
}';

        return response()->json(json_decode($json_to), 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}


 //SOURCES

/*
https: //carbon.nesbot.com/docs/
https: //laracasts.com/discuss/channels/eloquent/laravel-timstamp-get-from-carbonparse
https: //laravel-news.com/authorization-gates
https: //thewebtier.com/laravel/understanding-roles-permissions-laravel/
https: //www.5balloons.info/user-role-based-authentication-and-access-control-in-laravel/
https: //scotch.io/tutorials/easier-datetime-in-laravel-and-php-with-carbon
https: //github.com/indexlabstz/eshangazi/*/



// MORE

/*
$this->ask('Hello! What is your firstname?', function(Answer $answer) {
// Save result
$this->firstname = $answer->getText();

$this->say('Nice to meet you '.$this->firstname);
//$this->askEmail();
});

$question = Question::create('Do you need a database?')
->fallback('Unable to create a new database')
->callbackId('create_database')
->addButtons([
Button::create('Of course')->value('yes'),
Button::create('Hell no!')->value('no'),
]);

$this->ask($question, function (Answer $answer) {
// Detect if button was clicked:
if ($answer->isInteractiveMessageReply()) {
$selectedValue = $answer->getValue(); // will be either 'yes' or 'no'
$selectedText = $answer->getText(); // will be either 'Of course' or 'Hell no!'

$this->say('Value or key '.$selectedText);
}
});

return \App\Department::find(1)->employees()->whereHas('vacations', function ($query) {
    $query->where('vacation_start', '>=', '2018-01-01 23:59:00')
        ->where('vacation_end', '<=', '2018-08-01 23:59:00');
})->with('vacations')->get();

$now = Carbon::now();
$start_date = Carbon::createFromFormat('Y-m-d H:i:s', $start_date);

if ($now->diffInDays($start_date) <= $now->addDays($this->dt_wait)) {
    return $this->employees()
        ->whereHas('vacations', function ($query) use ($start_date, $end_date, $now) {

            $rule = Rule::where('rule_name', 'vacation_rules')->first();

            Carbon::createFromFormat('Y-m-d H:i:s', $start_date);
            Carbon::createFromFormat('Y-m-d H:i:s', $end_date);

            $query->select('id')->where('vacation_start', '>=', $start_date)
                ->where('vacation_end', '<=', $end_date)
                ->where('vacation_start', '>', $now->addDays($this->dt_wait))
                ->distinct();
        })->get();
}

 */


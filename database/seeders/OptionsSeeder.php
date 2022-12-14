<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Options;

class OptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = [
            ["option_name"=>"website_logo","option_value"=>"logo.png"],
            ["option_name"=>"website_second_logo","option_value"=>"lg.png"],
            ["option_name"=>"app_name","option_value"=>"WindMitigation.network"],
            ["option_name"=>"website_email","option_value"=>"admin@windmitigations.com"],
            ["option_name"=>"mail_host","option_value"=>"mail.lbdstestdomain.com"],
            ["option_name"=>"mail_port","option_value"=>"465"],
            ["option_name"=>"mail_username","option_value"=>"wind@lbdstestdomain.com"],
            ["option_name"=>"mail_password","option_value"=>"%T(aSwMaB1Wv"],
            ["option_name"=>"mail_from_address","option_value"=>"wind@lbdstestdomain.com"],
            ["option_name"=>"mail_encryption","option_value"=>"tls"],
            ["option_name"=>"pusher_app_id","option_value"=>"1491874"],
            ["option_name"=>"pusher_app_key","option_value"=>"cdb5dfb1da13d59428cd"],
            ["option_name"=>"pusher_app_secret","option_value"=>"183916ae7c51fb45a86b"],
            ["option_name"=>"pusher_app_cluster","option_value"=>"us3"],
            ["option_name"=>"login_img","option_value"=>"hh.jpg"],
            ["option_name"=>"registration_img","option_value"=>"regg.jpg"],
            ["option_name"=>"registration_logo_img","option_value"=>"yy.png"],
            ["option_name"=>"verification_message","option_value"=>"<p>Hi [first_name],</p><p>&nbsp; &nbsp; &nbsp;Welcome to Our Organization. I hope you are happy to a part of our organiztion.</p>"],
            ["option_name"=>"requestassign_message","option_value"=>"<p>Hi [first_name],</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your Request has been Successfully Assigned to [inspector_name].</p>"],
            ["option_name"=>"requestscheduled_message","option_value"=>"<p>Hi [first_name],</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your Request has been Successfully Scheduled by [inspector_name].</p>"],
            ["option_name"=>"requestunderreview_message","option_value"=>"<p>Hi [first_name],</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your Request has been Successfully Reviewed By [inspector_name].</p>"],
            ["option_name"=>"requestcompleted_message","option_value"=>"<p>Hi [first_name],</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your Inspestion Request has been Successfully Completed.</p>"]
        ];

        foreach($options as $key => $value)
        {
            Options::create([
                "option_name" =>  $value['option_name'],
                "option_value" => $value['option_value'],
            ]);
        }

    }
}

<?php

return [
    'admin' => 'admin',
    'employee' => 'employee',
    'employer' => 'employer',
    'gender' => [
        'male' => 1,
        'female' => 0,
    ],
    'employment_type' => [
        'Full-time',
        'Part-time',
        'Freelance',
        'Contract',
        'Internship',
    ],
    'status' => [
        'active' => 1,
        'inactive' => 0,
    ],
    'job_type' => [
        'full-time' => 'full-time',
        'part-time' => 'part-time',
        'contract' => 'contract',
        'remote' => 'remote',
        'temporary' => 'temporary',
        'internship' => 'internship',
    ],
    'num_top_users' => 10,
    'num_pages' => 2,
    'job_status' => [
        'hidden' => 0,
        'active' => 1,
    ],
    'application_form_status' => [
        'pending' => 0,
        'accepted' => 1,
        'rejected' => 2,
    ],
    'num_top_recent_jobs' => 5,
    'num_top_companies' => 10,
    'default_avt' => 'bower_components/job_light/images/avatar.png',
    'default_bg' => 'bower_components/job_light/images/cover.png',
    'message_max_length' => 20,
    'message' => [
        'read' => 1,
        'unread' => 0,
    ],
    'job_recommendation_sent_time' => '19:00',
];

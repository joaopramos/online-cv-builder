<?php
namespace App;

use App\User;
use App\Template;
use App\CV;
use App\Item;
use App\IemHeader;
use App\Section;
use App\Entry;
use App\CvHeader;


class UserSeeder
{

    protected static function newCv($cv) {
        $cv = (object) $cv;
        foreach ($cv->headers as $key => $value) {
            static::newCvHeader($cv->id, $key, $value);
        }
        foreach ($cv->sections as $section => $s) {
            static::newSection($cv->id, $section, $s['items']);
        }
    }

    protected static function newCvHeader($id, $name,$value) {
        CvHeader::create([
            'cv_id' => $id,
            'name' => $name,
            'value' => $value,
        ]);
    }

    protected static function newSection($id, $name, $items) {
        $section=Section::create([
            'cv_id' => $id,
            'name' => $name,
        ]);
        foreach ($items as $item) {
            $item = (object) $item;
            static::newItem($section->id, $item->name, $item->headers, $item->entries);
        }
    }

    protected static function newItem($id, $name, $headers, $entries) {
        $item=Item::create([
            'section_id' => $id,
            'name' => $name,
        ]);
        foreach ($headers as $header=>$value) {
            ItemHeader::create([
                'item_id' => $item->id,
                'name' => $header,
                'value' => $value,
            ]);
        }
        foreach ($entries as $key=>$entry) {
            Entry::create([
                'item_id' => $item->id,
                'entry' => $entry,
                'ordered' => $key,
            ]);
        }
    }


    public static function seedCv(CV $cv) {

        $miniLorem = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod";
        $lorem =
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod"
            ." tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,"
            ." quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo "
            ."consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse "
            ."cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non "
            ."proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n";
        $curriculum = [
            'id' => $cv->id,
            'headers' => [
                'name'=>'my name',
                'address'=>'my address',
                'phone'=>'11111 111 1111',
                'email'=>'my@email.com',
            ],
            'sections' => [
                'profile' => [
                    'items' => [
                        [
                            'name' => 'personal statement',
                            'headers' => [
                            ],
                            'entries' => [ $lorem, $lorem ]
                        ],
                    ],
                ],
                'skills' => [
                    'items' => [
                        [
                            'name' => 'skill1',
                            'headers' => [
                            ],
                            'entries' => [ $miniLorem ]
                        ],
                        [
                            'name' => 'skill2',
                            'headers' => [
                            ],
                            'entries' => [ $miniLorem ]
                        ],
                        [
                            'name' => 'skill3',
                            'headers' => [
                            ],
                            'entries' => [ $miniLorem ]
                        ],
                    ],
                ],
                'experience' => [
                    'items' => [
                        [
                            'name' => 'position - employer',
                            'headers' => [
                                'start' => '2015',
                                'end' => 'Present'
                            ],
                            'entries' => [ $miniLorem ]
                        ],
                        [
                            'name' => 'position - employer',
                            'headers' => [
                                'start' => '2010',
                                'end' => '2014'
                            ],
                            'entries' => [ $miniLorem ]
                        ],
                    ],
                ],
                'education' => [
                    'items' => [
                        [
                            'name' => 'degree - school',
                            'headers' => [
                                'start' => '2006',
                                'end' => '2009'
                            ],
                            'entries' => [ $miniLorem ]
                        ],
                        [
                            'name' => 'degree - school',
                            'headers' => [
                                'start' => '2005',
                                'end' => '2002'
                            ],
                            'entries' => [ $miniLorem ]
                        ],
                    ],
                ],
                'portfolio' => [
                    'items' => [
                        [
                            'name' => 'my portfolio',
                            'headers' => [
                            ],
                            'entries' => [ $miniLorem, $miniLorem ]
                        ],
                    ],
                ],
                'references' => [
                    'items' => [
                        [
                            'name' => 'references',
                            'headers' => [
                            ],
                            'entries' => [ 'Available on request.' ]
                        ],
                    ],
                ],
                'about' => [
                    'items' => [
                        [
                            'name' => 'interests',
                            'headers' => [
                            ],
                            'entries' => [ '...' ]
                        ],
                    ],
                ],
            ],
        ];

        static::newCv($curriculum);
    }
}

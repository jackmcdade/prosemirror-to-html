<?php

namespace Scrumpy\ProseMirrorToHtml\Test\Nodes;

use Scrumpy\ProseMirrorToHtml\Renderer;
use Scrumpy\ProseMirrorToHtml\Test\TestCase;

class TableTest extends TestCase
{
    /** @test */
    public function table_gets_rendered_correctly()
    {
        $json = [
            'type'    => 'doc',
            'content' => [
                [
                    'type'    => 'table',
                    'content' => [
                        [
                            'type'    => 'table_row',
                            'content' => [
                                [
                                    'type'    => 'table_header',
                                    'content' => [
                                        [
                                            'type'    => 'paragraph',
                                            'content' => [
                                                [
                                                    'type' => 'text',
                                                    'text' => 'text in header cell',
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'type'    => 'table_header',
                                    'attrs'   => [
                                        'colspan'  => 2,
                                        'colwidth' => [
                                            100,
                                            0,
                                        ],
                                    ],
                                    'content' => [
                                        [
                                            'type'    => 'paragraph',
                                            'content' => [
                                                [
                                                    'type' => 'text',
                                                    'text' => 'text in header cell with colspan 2',
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'type'    => 'table_row',
                            'content' => [
                                [
                                    'type'    => 'table_cell',
                                    'attrs'   => [
                                        'rowspan' => 2,
                                    ],
                                    'content' => [
                                        [
                                            'type'    => 'paragraph',
                                            'content' => [
                                                [
                                                    'type' => 'text',
                                                    'text' => 'paragraph 1 in cell with rowspan 2',
                                                ],
                                            ],
                                        ],
                                        [
                                            'type'    => 'paragraph',
                                            'content' => [
                                                [
                                                    'type' => 'text',
                                                    'text' => 'paragraph 2 in cell with rowspan 2',
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'type'    => 'table_cell',
                                    'content' => [
                                        [
                                            'type'    => 'paragraph',
                                            'content' => [
                                                [
                                                    'type' => 'text',
                                                    'text' => 'foo',
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'type'    => 'table_cell',
                                    'content' => [
                                        [
                                            'type'    => 'paragraph',
                                            'content' => [
                                                [
                                                    'type' => 'text',
                                                    'text' => 'bar',
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'type'    => 'table_row',
                            'content' => [
                                [
                                    'type'    => 'table_cell',
                                    'content' => [
                                        [
                                            'type'    => 'paragraph',
                                            'content' => [
                                                [
                                                    'type' => 'text',
                                                    'text' => 'foo',
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'type'    => 'table_cell',
                                    'content' => [
                                        [
                                            'type'    => 'paragraph',
                                            'content' => [
                                                [
                                                    'type' => 'text',
                                                    'text' => 'bar',
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $html = '<table><tbody>' .
            '<tr>' . '<th><p>text in header cell</p></th>' . '<th colspan="2" data-colwidth="100,0"><p>text in header cell with colspan 2</p></th>' . '</tr>' .
            '<tr>' . '<td rowspan="2"><p>paragraph 1 in cell with rowspan 2</p><p>paragraph 2 in cell with rowspan 2</p></td>' . '<td><p>foo</p></td>' . '<td><p>bar</p></td>' . '</tr>' .
            '<tr>' . '<td><p>foo</p></td>' . '<td><p>bar</p></td>' . '</tr>' .
            '</tbody></table>';

        $this->assertEquals($html, (new Renderer)->render($json));
    }
}

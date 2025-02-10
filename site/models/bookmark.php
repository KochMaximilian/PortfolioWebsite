<?php


class BookmarkPage extends Page {

    public function categoryIcon (){
       
        return match ($this->category()->value()) {
            'Game Design' => 'box',
            'Level Design' => 'folder-structure',
            'System Design' => 'grid-top-right',
            'Game Development' => 'cog',
            'Shader' => 'code',
            'Unity' => 'heart',
            'Unreal Engine' => 'heart-filled',
            'Blender' => 'template',
            'Asset' => 'file-document',
            'Plugin' => 'file-code',
            'Tool' => 'pen',
            'Tutorial' => 'question',
            'Article' => 'quote',
            'Blog' => 'text-justify',
            default => 'bookmark',
        };
    }

    public function categoryColor (){

            
        return match ($this->category()->value()) {
            'Game Design' => '#14199D',
            'Level Design' => '#2B2670',
            'System Design' => '#303143',
            'Game Development' => '#2F2F34',
            'Shader' => '#282729',
            'Unity' => '#861210',
            'Unreal Engine' => '#790D18',
            'Blender' => 'template',
            'Asset' => '#60121D',
            'Plugin' => '#5A0C17',
            'Tool' => '#520E1E',
            'Tutorial' => '#4A4C20',
            'Article' => '#19151E',
            'Blog' => '#2E3136',
            default => 'white',
        };
    }
}
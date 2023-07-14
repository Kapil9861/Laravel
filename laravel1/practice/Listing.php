<?php
namespace App\Models;

class Listing{
 public static function all(){
    return [
        [
        'id'=>1,
        'Name'=>"Apple",
        'title'=>'Listing One',
        'description'=>"An apple is a round, edible fruit produced by an apple tree (Malus domestica).
         Apple trees are cultivated worldwide and are the most widely grown species in the genus Malus.
          The tree originated in Central Asia, where its wild ancestor, Malus sieversii, is still found.
           Apples have been grown for thousands of years in Asia and Europe and were introduced to North 
           America by European colonists. Apples have religious and mythological
         significance in many cultures, including Norse, Greek, and European Christian tradition."

    ],
    [
        'id'=>2,
        'Name'=>"Banana",
        'title'=>"listing two",
        'description'=>"A banana is an elongated, edible fruit 
        - botanically a berry[1][2] - produced by several kinds of large herbaceous 
        flowering plants in the genus Musa.[3] In some countries, bananas used for cooking
         may be called 'plantains', distinguishing them from dessert bananas. The fruit 
         is variable in size, color, and firmness, but is usually elongated and curved,
          with soft flesh rich in starch covered with a rind, which may be green, yellow,
           red, purple, or brown when ripe. The fruits grow upward in clusters near the top
            of the plant. Almost all modern edible seedless (parthenocarp) bananas come from
             two wild species - Musa acuminata and Musa balbisiana. The scientific names of most 
             cultivated bananas are Musa acuminata, Musa balbisiana, and Musa x paradisiaca for
              the hybrid Musa acuminata x M. balbisiana, depending on their genomic constitution.
         The old scientific name for this hybrid, Musa sapientum, is no longer used."
    ]
    ];

 }
 public static function find($id){
    $listings=self::all();
    foreach($listings as $listing){
        if($listing['id']==$id){
            return $listing;
        }
    }
 }
}

?>
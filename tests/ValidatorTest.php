<?php

namespace Tests;

use App\Core\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase {

    /** @test */
    public function is_required_empty() {

        $validator = new Validator();
        $validator->validate(['name' => ''], ['name' => ['required']]);

        $this->assertIsArray($validator->error());
    }

    /** @test */
    public function required_not_empty() {

        $validator = new Validator();
        $validator->validate(['name' => 'test'], ['name' => ['required']]);

        $this->assertFalse($validator->error());
    }

    /** @test */
    public function is_maxlen_greater() {

        $validator = new Validator();
        $validator->validate(['name' => '123456789'], ['name' => ['maxLen' => 5]]);

        $this->assertIsArray($validator->error());
    }

    /** @test */
    public function is_maxlen_equal() {

        $validator = new Validator();
        $validator->validate(['name' => '12345'], ['name' => ['maxLen' => 5]]);

        $this->assertFalse($validator->error());
    }

    /** @test */
    public function is_amount_empty_string() {

        $validator = new Validator();
        $validator->validate(['balance' => ''], ['balance' => ['amount']]);
        $this->assertIsArray($validator->error());
        
    }
    
    /** @test */
    public function is_amount_a_string() {
        
        $validator = new Validator();
        $validator->validate(['balance' => '22str'], ['balance' => ['amount']]);
        $this->assertIsArray($validator->error());
        
    }
    
    /** @test */
    public function is_amount_a_null() {
        
        $validator = new Validator();
        $validator->validate(['balance' => null], ['balance' => ['amount']]);
        $this->assertIsArray($validator->error());
        
    }
    
    /** @test */
    public function is_amount_a_bool_false() {
        
        $validator = new Validator();
        $validator->validate(['balance' => false], ['balance' => ['amount']]);
        $this->assertIsArray($validator->error());
        
    }
    
    /** @test */
    public function is_amount_a_bool_true() {
        
        $validator = new Validator();
        $validator->validate(['balance' => true], ['balance' => ['amount']]);
        $this->assertIsArray($validator->error());
        
    }
    
    /** @test */
    public function is_amount_less_then_zero() {
        
        $validator = new Validator();
        $validator->validate(['balance' => -1], ['balance' => ['amount']]);
        $this->assertIsArray($validator->error());
        
    }
    
    /** @test */
    public function is_not_in_array() {
        
        $validator = new Validator();
        $validator->validate(['value' => 1], ['value' => ['in' => [2, 3]]]);
        $this->assertIsArray($validator->error());
        
    }
    
    
    /** @test */
    public function is_notequal() {
        
        $validator = new Validator();
        $validator->validate(['value' => 1], ['value' => ['notequal' => 1]]);
        $this->assertIsArray($validator->error());
        
    }
    
    /** @test */
    public function is_min() {
        
        $validator = new Validator();
        $validator->validate(['value' => 1], ['value' => ['min' => 2]]);
        $this->assertIsArray($validator->error());
        
    }
    
}

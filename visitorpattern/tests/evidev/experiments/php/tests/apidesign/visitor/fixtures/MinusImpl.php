<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * The MIT License
 *
 * Copyright 2013 Eric VILLARD <dev@eviweb.fr>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * 
 * @package     evidev\experiments\php\tests\apidesign\visitor\fixtures
 * @author      Eric VILLARD <dev@eviweb.fr>
 * @copyright	(c) 2013 Eric VILLARD <dev@eviweb.fr>
 * @license     http://opensource.org/licenses/MIT MIT License
 */

namespace evidev\experiments\php\tests\apidesign\visitor\fixtures;

use \evidev\experiments\php\apidesign\Visitor;
use \evidev\experiments\php\apidesign\Expression;
use \evidev\experiments\php\apidesign\expression\Minus;

/**
 * Minus expression implementation
 * 
 * @package     evidev\experiments\php\tests\apidesign\visitor\fixtures
 * @author      Eric VILLARD <dev@eviweb.fr>
 * @copyright	(c) 2013 Eric VILLARD <dev@eviweb.fr>
 * @license     http://opensource.org/licenses/MIT MIT License
 */
final class MinusImpl implements Minus
{
    /**
     * first member of final expression
     * 
     * @var Expression 
     */
    private $first;
    
    /**
     * second member of final expression
     * 
     * @var Expression 
     */
    private $second;
    
    /**
     * constructor
     * 
     * @param \evidev\experiments\php\apidesign\Expression $first   first expression member
     * @param \evidev\experiments\php\apidesign\Expression $second  second expression member
     */
    private function __construct(Expression $first, Expression $second)
    {
        $this->first = $first;
        $this->second = $second;
    }
    
    /**
     * factory method
     * 
     * @param \evidev\experiments\php\apidesign\Expression $first   first expression member
     * @param \evidev\experiments\php\apidesign\Expression $second  second expression member
     * @return PlusImpl
     */
    public static function create(Expression $first, Expression $second)
    {
        return new static($first, $second);
    }

    /**
     * @inheritdoc
     */
    public function getFirst()
    {
        return $this->first;
    }

    /**
     * @inheritdoc
     */
    public function getSecond()
    {
        return $this->second;
    }

    /**
     * @inheritdoc
     */
    public function visit(Visitor $visitor)
    {
        $visitor->dispatchMinus($this);
    }
}

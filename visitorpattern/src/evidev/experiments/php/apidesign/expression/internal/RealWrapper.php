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
 * @package     evidev\experiments\php\apidesign\expression\internal
 * @author      Eric VILLARD <dev@eviweb.fr>
 * @copyright	(c) 2013 Eric VILLARD <dev@eviweb.fr>
 * @license     http://opensource.org/licenses/MIT MIT License
 */

namespace evidev\experiments\php\apidesign\expression\internal;

use \evidev\experiments\php\apidesign\Visitor;
use \evidev\experiments\php\apidesign\expression\Number;
use \evidev\experiments\php\apidesign\expression\Real;

/**
 * Real wrapper
 * 
 * @package     evidev\experiments\php\apidesign\expression\internal
 * @author      Eric VILLARD <dev@eviweb.fr>
 * @copyright	(c) 2013 Eric VILLARD <dev@eviweb.fr>
 * @license     http://opensource.org/licenses/MIT MIT License
 */
final class RealWrapper implements Real
{
    /**
     * wrapped Number
     * 
     * @var Number
     */
    private $number;

    /**
     * constructor
     *
     * @param Number $number    wrapped Number instance
     */
    private function __construct(Number $number)
    {
        $this->number = $number;
    }

    /**
     * factory method
     *
     * @param Number $number    wrapped Number instance
     * @return RealWrapper
     */
    public static function create(Number $number)
    {
        return new static($number);
    }

    /**
     * @inheritdoc
     */
    public function getValue()
    {
        return (double) $this->number->getValue();
    }

    /**
     * @inheritdoc
     */
    public function visit(Visitor $visitor)
    {
        $this->number->visit($visitor);
    }
}

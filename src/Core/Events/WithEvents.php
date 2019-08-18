<?php

/**
 * Events
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * @category  Library
 * @package   Events
 * @author    Axel Nana <ax.lnana@outlook.com>
 * @copyright 2019 Aliens Group.
 * @license   MIT <https://github.com/ElementaryFramework/Events/blob/master/LICENSE>
 * @version   GIT: 0.0.1
 */

namespace ElementaryFramework\Core\Events;

/**
 * Event Emitter Trait
 *
 * Methods used to emit events
 *
 * @package    Events
 * @author     Axel Nana <ax.lnana@outlook.com>
 */
trait WithEvents
{
    /**
     * The events buffer.
     *
     * @var array
     */
    private $_events = array();

    /**
     * Add a callback to an event channel.
     *
     * @param int      $event    The event name.
     * @param callable $callback The event callback.
     *
     * @return void
     */
    public function on(int $event, callable $callback): void
    {
        if (!isset($this->_events[$event]))
            $this->_events[$event] = array();

        array_push($this->_events[$event], $callback);
    }

    /**
     * Emit an event.
     *
     * @param integer $event  The event to emit.
     * @param mixed[] $params The list of parameters to pass to the callback.
     *
     * @return void
     */
    public function emit(int $event, ...$params)
    {
        if (!isset($this->_events[$event]))
            return;

        foreach ($this->_events[$event] as $callback) {
            call_user_func_array($callback, $params);
        }
    }
}
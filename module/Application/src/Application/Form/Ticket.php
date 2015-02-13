<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace Application\Form;

use Zend\Form\Form;
use Zend\Http\Request;

class Ticket extends Form
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);

        $this->setAttribute('method', Request::METHOD_POST);

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'subject',
            'type' => 'text',
            'options' => [
                'label' => 'Subject',
            ],
            'attributes' => [
                'placeholder' => 'Subject',
            ],
        ]);

        $this->add([
            'name' => 'description',
            'type' => 'textarea',
            'options' => [
                'label' => 'Description',
            ],
            'attributes' => [
                'placeholder' => 'Description',
            ],
        ]);

        $this->add([
            'name' => 'importance',
            'type' => 'select',
            'options' => [
                'label' => 'Importance',
                'value_options' => [
                    // @todo use class constants, when we have them
                    1 => 'Low',
                    2 => 'Medium',
                    3 => 'High',
                    4 => 'Emergency',
                ]
            ],
        ]);

        $this->add([
            'name' => 'opened_by',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'status',
            'type' => 'select',
            'options' => [
                'label' => 'Status',
            ],
        ]);

        $this->add([
            'name' => 'responsible',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',

            'attributes' => [
                'value' => 'Open Ticket',
                'class' => 'btn btn-success',
            ]
        ]);
    }
}

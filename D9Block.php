<?php

namespace Drupal\example_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an 'ExampleBlock' block.
 *
 * @Block(
 *  id = "example_block",
 *  admin_label = @Translation("Example block"),
 * )
 */
class ExampleBlock extends BlockBase
{

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        $build = [];

        $properties = \Drupal::entityTypeManager()->getStorage('node')
            ->loadByProperties(['type' => 'property', 'status' => 1]);

        $markup = '<ul>';
        foreach ($properties as $property) {
            var_dump($property->get('field_show_in_list')->getValue());
            $field_show_in_list = $property->get('field_show_in_list')->getValue();
            $link = '<a href="/node/' . $property->id() . '">' . $property->label() . '</a>';
            if ($field_show_in_list = true) {
                $markup .= '<li><h3>' . $link . '</h3></li>';
            }

        }
        $markup .= '</ul>';

        $markup .= 'There are ' . count($properties) . ' properties.';
        //$markup .= 'There are 3 properties.';

        $build['example_block']['#markup'] = $markup;

        return $build;
    }

}
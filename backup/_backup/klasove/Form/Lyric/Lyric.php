<?php

namespace Form\Lyric;

use Zend\Form\Form,
    Zend\Form\Element,
    Zend\Validator,
    Zend\Form\Decorator\HtmlTag

;

class Lyric extends Form {

    function __construct($name = null) {
        parent::__construct($name);


        $this->setName('album');
        $this->setAttribute('method', 'post');

        // Id
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));
    }

    public function init() {


        throw new \Exception('tova e preraboteno');

        $this->setElementsBelongTo('lyric');

        for ($i = 1; $i <= 5; $i++) {

            $artist = new Element\Text('artist' . $i);
            $artist
                    ->setAttrib('autocomplete', 'off')
                    ->removeDecorator('HtmlTag')
            ;

            /* @var $artistLabel \Zend\Form\Decorator\Label */
            $artistLabel = $artist->getDecorator('Label');
            $artistLabel->setTag('div');

            $artistName = new Element\Text('artist' . $i . '_name');
            $artistName
                    ->setLabel('име')
                    ->setAttrib('readonly', 'readonly')
                    ->removeDecorator('Label')
                    ->removeDecorator('HtmlTag')
            ;


            $artistId = new Element\Text('artist' . $i . '_id');
            $artistId
                    ->removeDecorator('Label')
                    ->removeDecorator('HtmlTag')
            ;


            $this->addElements(array(
                $artist,
                $artistName,
                $artistId,
            ));

            $this->addDisplayGroup(array(
                'artist' . $i,
                'artist' . $i . '_name',
                'artist' . $i . '_id'
                    ), 'dgArtist' . $i . ''
            );

            $displayGroup = $this->getDisplayGroup('dgArtist' . $i);
            $displayGroup->addDecorator(new \Tekstove\Form\Decorator\ArtistChoose(array(
                        'elementId' => $artist->getId(),
                    )));

            $displayGroup->addDecorator(new \Zend\Form\Decorator\HtmlTag(array('tag' => 'div')))
                    ->removeDecorator('DtDdWrapper');
            $displayGroup->setOrder($i * 10);
            $displayGroup->setLegend('Изпълнител ' . $i);
        }


        $title = new Element\Text('title');
        $titleRequired = new Validator\NotEmpty();
        $title->setRequired()
                ->addValidators(array(
                    $titleRequired
                ))
                ->setLabel('заглавие')
                ->setOrder(100)
        ;

        $text = new Element\Textarea('text');
        $text
                ->setRequired()
                ->setAttrib('style', 'width:500px')
        ;


        $textTranslated = new Element\Textarea('textTranslated');
        $textTranslated->setAttrib('style', 'width:500px');

        $album1 = new Element\Text('album1');
        $album1->setLabel('албум');

        $album2 = new Element\Text('album2');
        $album2->setLabel('албум');

        $videoVbox = new Element\Text('videoVbox');
        $videoVbox->setLabel('видео Vbox7');

        $videoYoutube = new Element\Text('videoYoutube');
        $videoYoutube->setLabel('видео YouTube');

        $image = new Element\Text('image');
        $image->setLabel('Картинка');

        $language = new Element\Select('language');
        $language->setMultiOptions(\lyric::ezici())
                ->setLabel('Език на песента')
                ->addValidator(new Validator\InArray(array_keys(\lyric::ezici())))
        ;

        $info = new Element\Textarea('info');
        $info->setLabel('Допълнителна информация')
        ;

        $submit = new Element\Submit('submit');
        $submit
                ->setLabel('запис')
                ->setOrder(100000)
        ;




        $this->addElements(array(
            $title,
            $text,
            $textTranslated,
            $album1, $album2,
            $videoVbox, $videoYoutube,
            $image,
            $info,
            $language,
            $submit,
        ));


        $this->addDisplayGroup(array('text', 'textTranslated'), 'dgText')
        ;
        $this->getDisplayGroup('dgText')
                ->getDecorator('HtmlTag')->setTag('div')->removeOption('tag');
        $this->getDisplayGroup('dgText')
                ->getDecorator('HtmlTag')->setOption('id', $this->getDisplayGroup('dgText')->getId() . '-div');
        $this->getDisplayGroup('dgText')->setOrder(1000);
        $this->getDisplayGroup('dgText')->setLegend('Текст и превод');

        foreach ($this->getDisplayGroup('dgText')->getElements() as $element) {
            $element->removeDecorator('Htmltag')
                    ->removeDecorator('Label')
            ;
        }

        $this->addDisplayGroup(array(
            'album1', 'album2',
            'videoVbox', 'videoYoutube',
            'image',
            'info',
            'language',
                ), 'dgEtc');
        $dgEtc = $this->getDisplayGroup('dgEtc');
        $dgEtc->setOrder(10000);

        foreach (\lyric::janrove() as $key => $name) {
            $checkbox = new \Zend\Form\Element\Checkbox($key);
            $checkbox->setLabel($name)
            ;
            $dgEtc->addElement($checkbox);
        }

        $this->addDisplayGroup(array('submit'), 'dgBottom');
        $this->getDisplayGroup('dgBottom')->setOrder(100000);
    }

}
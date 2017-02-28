<?php
/*
* This file is part of EC-CUBE
*
* Copyright(c) 2000-2015 LOCKON CO.,LTD. All Rights Reserved.
* http://www.lockon.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/
/*
 * [メルマガ配信]-[配信内容設定]用Form
 */

namespace Plugin\MailMagazine\Form\Type;

use Eccube\Form\Type\Master\CategoryType;
use Eccube\Form\Type\Master\PageMaxType;
use Eccube\Form\Type\Master\PrefType;
use Eccube\Form\Type\Master\SexType;
use Eccube\Form\Type\Master\CustomerStatusType;
use Eccube\Form\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class MailMagazineType extends AbstractType
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $config = $this->app['config'];
        $builder
            // 会員ID・メールアドレス・名前・名前(フリガナ)
            ->add('multi', TextType::class, array(
                'label' => '会員ID・メールアドレス・名前・名前(フリガナ)',
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => $config['stext_len'])),
                ),
            ))
            ->add('company_name', TextType::class, array(
                'label' => '会社名',
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => $config['stext_len'])),
                ),
            ))
            ->add('pref', PrefType::class, array(
                'label' => '都道府県',
                'required' => false,
            ))
            ->add('sex', SexType::class, array(
                'label' => '性別',
                'required' => false,
                'expanded' => true,
                'multiple' => true,
            ))
            ->add('birth_month', ChoiceType::class, array(
                'label' => '誕生月',
                'required' => false,
                'choices' => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12),
            ))
            ->add('birth_start', BirthdayType::class, array(
                'label' => '誕生日',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'placeholder' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('birth_end', BirthdayType::class, array(
                'label' => '誕生日',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'placeholder' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('tel', TelType::class, array(
                'label' => '電話番号',
                'required' => false,
            ))
            ->add('buy_total_start', IntegerType::class, array(
                'label' => '購入金額',
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => $config['price_len'])),
                ),
            ))
            ->add('buy_total_end', IntegerType::class, array(
                'label' => '購入金額',
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => $config['price_len'])),
                ),
            ))
            ->add('buy_times_start', IntegerType::class, array(
                'label' => '購入回数',
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => $config['int_len'])),
                ),
            ))
            ->add('buy_times_end', IntegerType::class, array(
                'label' => '購入回数',
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => $config['int_len'])),
                ),
            ))
            ->add('create_date_start', DateType::class, array(
                'label' => '登録日',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'placeholder' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('create_date_end', DateType::class, array(
                'label' => '登録日',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'placeholder' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('update_date_start', DateType::class, array(
                'label' => '更新日',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'placeholder' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('update_date_end', DateType::class, array(
                'label' => '更新日',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'placeholder' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('last_buy_start', DateType::class, array(
                'label' => '最終購入日',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'placeholder' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('last_buy_end', DateType::class, array(
                'label' => '最終購入日',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'placeholder' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('buy_product_name', TextType::class, array(
                'label' => '購入商品名',
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => $config['stext_len'])),
                ),
            ))
            ->add('buy_product_code', TextType::class, array(
                'label' => '購入商品コード',
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => $config['stext_len'])),
                ),
            ))
            ->add('buy_category', CategoryType::class, array(
                'label' => '商品カテゴリ',
                'required' => false,
            ))
          // TODO DBから取得するのが正しいので修正
//             ->add('customer_status', 'choice', array(
//                 'label' => '会員ステータス',
//                 'required' => false,
//                 'choices' => array(
//                     '1' => '仮会員',
//                     '2' => '本会員',
//                 ),
//                 'expanded' => true,
//                 'multiple' => true,
//                 'empty_value' => false,
//             ))
            ->add('customer_status', CustomerStatusType::class, array(
                    'label' => '会員ステータス',
                    'required' => false,
                    'expanded' => true,
                    'multiple' => true,
            ))

            ->add('pageno', HiddenType::class, array(
            ))
            ->add('pagemax', PageMaxType::class, array(
            ))
            // 以降テンプレート選択で使用する項目
            ->add('id', HiddenType::class)
            ->add('template', 'mail_magazine_template', array(
                'label' => 'テンプレート',
                'required' => false,
                'mapped' => false,
            ))
            ->add('subject', TextType::class, array(
                'label' => '件名',
                'required' => true,
            ))
            ->add('body', TextareaType::class, array(
                'label' => '本文 (テキスト形式)',
                'required' => true,
            ))
            ->add('htmlBody', TextareaType::class, array(
                'label' => '本文 (HTML形式)',
                'required' => false,
            ))
            ->addEventSubscriber(new \Eccube\Event\FormEventSubscriber());
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mail_magazine';
    }
}

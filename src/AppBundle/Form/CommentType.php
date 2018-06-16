<?php 

namespace AppBundle\Form;

use Symfony\Component\Form\{AbstractType, FormBuilderInterface};
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{ChoiceType, HiddenType, SubmitType, TextType, TextareaType};

class CommentType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

    	$choices = array();
    	if($options['repositories'])
    		foreach($options['repositories'] as $item)
    			$choices[$item->name] = $item->name;

        $builder->add('title', TextType::class, array('label'=>"Titre"));
        $builder->add('git', ChoiceType::class, array('label'=>"Dépot GIT", 'choices'=>$choices));
        $builder->add('content', TextareaType::class, array('label'=>"Commentaire"));
        $builder->add('user_source', HiddenType::class);
        $builder->add('user_target', HiddenType::class);
        $builder->add('submit', SubmitType::class, array('label'=>"Envoyer"));
    }

    public function configureOptions(OptionsResolver $resolver) {

        $options['data_class'] = 'AppBundle\Entity\Comment';
        $options['repositories'] = array();

        $resolver->setDefaults($options);
    }
}
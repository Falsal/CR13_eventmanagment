<?php

namespace App\Controller;
//form related packages added
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

use App\Entity\Event;  #this is added manually
use Symfony\Component\HttpFoundation\Request;//form submission package added

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    // ===================== index =====================================

    #[Route('/', name: 'event')]
    public function index(): Response
    {
        $events=$this->getDoctrine()->getRepository('App:Event')->findAll();
        
        return $this->render('event/index.html.twig', [
            'events' => $events
        ]);
    }

    // ===================== create =====================================
    #[Route('/create', name: 'create_event')]
    public function createEvent(Request $request): Response
    {
        #create a record from the class Event (contains all attributes)
        $event=new Event;
        $form=$this->createFormBuilder($event)
        
        ->add('name', TextType::class,array("attr"=> array("class"=>"form-control","style"=>"margin-bottom=15px")))
        
        ->add('date', DateTimeType::class, array('attr' => array('style'=>'margin-bottom:15px, width: 25%')))

        ->add('description', TextareaType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))

        ->add('image', TextType::class,array("attr"=> array("class"=>"form-control","style"=>"margin-bottom=15px")))

        ->add('capacity', IntegerType::class, array('attr' => array("class"=>"form-control",'style'=>'margin-bottom:15px')))

        ->add('email', EmailType::class,array("attr"=> array("class"=>"form-control","style"=>"margin-bottom=15px")))

        ->add('phone', TextType::class,array("attr"=> array("class"=>"form-control","style"=>"margin-bottom=15px")))

        ->add('address', TextType::class,array("attr"=> array("class"=>"form-control","style"=>"margin-bottom=15px")))

        ->add('evt_url', TextType::class,array("attr"=> array("class"=>"form-control","style"=>"margin-bottom=15px")))

     
        ->add('type', ChoiceType::class, array('choices'=>array('Music'=>'Music','Sport'=>'Sport', 'Museum'=>'Museum'),'attr' => array('class'=> 'form-control', 'style'=>'margin-botton:30px')))

        ->add('save', SubmitType::class, array('label'=> 'Create Event', 'attr' => array('class'=> 'btn-success', 'style'=>'margin-top:15px')  )   )
    
        ->getForm();

        $form->handleRequest($request);
        #handleRequest takes the POST’ed data from the previous request, processes it, and runs any validation (checks integrity of expected versus received data). it only does this for POST requests

        if($form->isSubmitted() && $form-> isValid()){
            $name=$form["name"]->getData();
            $date=$form['date']-> getData();
            $description=$form['description']-> getData();
            $image=$form['image']-> getData();
            $capacity=$form['capacity']-> getData();
            $email=$form["email"]->getData();
            $phone=$form['phone']-> getData();
            $address=$form['address']-> getData();
            $evt_url=$form['evt_url']-> getData();
            $type=$form['type']-> getData();
        
            
            $event->setName($name);
            $event->setDate($date);
            $event->setDescription($description);
            $event->setImage($image);
            $event->setCapacity($capacity);
            $event->setEmail($email);
            $event->setPhone($phone);
            $event->setAddress($address);
            $event->setEvtUrl($evt_url);
            $event->setType($type);
           
            $em = $this->getDoctrine()->getManager();

            $em->persist($event);
            $em->flush();
            #When you make flush() , Doctrine checks all the fields of all fetched data and make a transaction to the database. When you initialize a new object, it doesn't have any Doctrine metadata, so you have to call one more method, which is persist() to add it.
           
            $this->addFlash(
                'notice',
                'Event Added'
                );

            // this return takes us to index page after creating record
            return $this->redirectToRoute('event');
        }
            // this return goes to index after creating record
            return $this->render('event/create.html.twig', [
                "form" => $form->createView(), 'event' => $event
            ]); 
    }

    // ============================ edit =============================
       ################################################################

    #[Route('/edit/{id}', name: 'edit_event')]

    public function editEvent(Request $request,$id): Response
    {
        #pick the complete record with passed id, find() is from EventRepository
        $event = $this->getDoctrine()->getRepository('App:Event')->find($id);
        $form=$this->createFormBuilder($event)
        
        ->add('name', TextType::class,array("attr"=> array("class"=>"form-control","style"=>"margin-bottom=15px")))
        
        ->add('date', DateTimeType::class, array('attr' => array('style'=>'margin-bottom:15px, width: 25%')))

        ->add('description', TextareaType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))

        ->add('image', TextType::class,array("attr"=> array("class"=>"form-control","style"=>"margin-bottom=15px")))

        ->add('capacity', IntegerType::class, array('attr' => array("class"=>"form-control",'style'=>'margin-bottom:15px')))

        ->add('email', EmailType::class,array("attr"=> array("class"=>"form-control","style"=>"margin-bottom=15px")))

        ->add('phone', TextType::class,array("attr"=> array("class"=>"form-control","style"=>"margin-bottom=15px")))

        ->add('address', TextType::class,array("attr"=> array("class"=>"form-control","style"=>"margin-bottom=15px")))

        ->add('evt_url', TextType::class,array("attr"=> array("class"=>"form-control","style"=>"margin-bottom=15px")))

     
        ->add('type', ChoiceType::class, array('choices'=>array('Music'=>'Music','Sport'=>'Sport', 'Museum'=>'Museum'),'attr' => array('class'=> 'form-control', 'style'=>'margin-botton:30px')))

        ->add('save', SubmitType::class, array('label'=> 'Update', 'attr' => array('class'=> 'btn-success', 'style'=>'margin-top:15px')))
        ->add('edit', SubmitType::class, array('label'=> 'Back', 'attr' => array('class'=> 'btn-dark', 'style'=>'margin-top:15px', 'href'=>'/')))
    
        ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form-> isValid()){
            $name=$form["name"]->getData();
            $date=$form['date']-> getData();
            $description=$form['description']-> getData();
            $image=$form['image']-> getData();
            $capacity=$form['capacity']-> getData();
            $email=$form["email"]->getData();
            $phone=$form['phone']-> getData();
            $address=$form['address']-> getData();
            $evt_url=$form['evt_url']-> getData();
            $type=$form['type']-> getData();
        
            
            $event->setName($name);
            $event->setDate($date);
            $event->setDescription($description);
            $event->setImage($image);
            $event->setCapacity($capacity);
            $event->setEmail($email);
            $event->setPhone($phone);
            $event->setAddress($address);
            $event->setEvtUrl($evt_url);
            $event->setType($type);
           
            $em = $this->getDoctrine()->getManager();

            $em->persist($event);
            $em->flush();
           
            $this->addFlash(
                'notice',
                'Event edited'
                );

            // takes us to index page after form submission/creating record
            return $this->redirectToRoute('event');
        }

        // dd($event);
        return $this->render('event/edit.html.twig', [
            "form" => $form->createView(), 'event' => $event
            ]);
    }

    // ===================== details =====================================
    #[Route('/details/{id}', name: 'details_event')]
  
   public function details($id): Response
   {
       $event = $this->getDoctrine()->getRepository('App:Event')->find($id);
       
       return $this->render('event/details.html.twig', array('event' => $event));
   }

    // ===================== delete =====================================
    #[Route('/delete/{id}', name: 'delete_event')]
    
    public function deleteEvent($id){

        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('App:Event')->find($id);
        $em->remove($event);
        $em->flush();
        
        $this->addFlash(
            'notice',
            'Event Deleted'
        );
        // dd($id);
        return $this->render('event/delete.html.twig', [
            
              'delId' => $id  ]);
        
        // $this->redirectToRoute('todo');
    }
    
}

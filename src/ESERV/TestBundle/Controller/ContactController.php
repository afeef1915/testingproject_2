<?php

namespace ESERV\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ESERV\TestBundle\Form\Contact;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ESERV\TestBundle\Services\ESERVTestBundleQtsRangeServices;
use Symfony\Component\DependencyInjection\Container;

class ContactController extends Controller
{

    public function addAction()
    {
        $action_url = $this->generateUrl('gtcw_contact_create_test');
        $form = $this->createForm($this->container->get('contact_form_service'), null, array(
            'action' => $action_url,
        ));

        return $this->render(
                        'ESERVTestBundle:Default:contact.html.twig', array('form' => $form->createView())
        );
    }

    public function createAction(Request $request)
    {
        $form = $this->createForm($this->container->get('contact_form_service'), null);

        $form->handleRequest($request);
        $em1 = $this->getDoctrine()->getManager();


        if ($form->isValid()) {
            $form_data = $request->request->get('contact');

            $em1->getConnection()->beginTransaction();
            try {
                $user = new \ESERV\MAIN\ContactBundle\Entity\Contact();

                $user->setDisplayName($form_data['first_name'] . ' ' . $form_data['last_name']);
                $user->setStatusDate(new \DateTime());
                $user->setContactStatusId(1);
                $user->setExternalId(1);
                $user->setCreatedAt(new \DateTime());
                $user->setUpdatedAt(new \DateTime());
                $user->setCreatedBy(1);
                $user->setUpdatedBy(1);

                $em1->persist($user);
                $em1->flush();

                $contact_id = $user->getId();

                $contact_entity = $em1->getRepository('ESERVMAINContactBundle:Contact')->findOneBy(array('id' => $contact_id));

                $person = new \ESERV\MAIN\ContactBundle\Entity\Person();
                $person->setFirstName($form_data['first_name']);
                $person->setLastName($form_data['last_name']);
                $person->setInitials($form_data['initials']);
                $person->setContact($contact_entity);
                $person->setTitleId(1);
                $person->setJobTitle('Test title');
                $person->setGenderId(1);
                $person->setDateOfBirth(new \DateTime());
                $person->setExternalId(1);
                $person->setCreatedAt(new \DateTime());
                $person->setUpdatedAt(new \DateTime());
                $person->setCreatedBy(1);
                $person->setUpdatedBy(1);

                $em1->persist($person);
                $em1->flush();

                $address = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Address();
                $address->setContact($contact_entity);
                $address->setAddressTypeId(2);
                $address->setAddCountryId(2);
                $address->setAddressLine1($form_data['addressLine1']);
                $address->setAddressLine2($form_data['addressLine2']);
                $address->setAddressLine3($form_data['addressLine3']);
                $address->setTown($form_data['town']);
                $address->setCounty($form_data['postcode']);
                $address->setPostcode($form_data['county']);
                $address->setStartDate(new \DateTime());
                $address->setExternalId(1);
                $address->setCreatedAt(new \DateTime());
                $address->setUpdatedAt(new \DateTime());
                $address->setCreatedBy(1);
                $address->setUpdatedBy(1);

                $website = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Website();
                $website->setContact($contact_entity);
                $website->setCreatedAt(new \DateTime());
                $website->setCreatedBy(1);
                $website->setExternalId(1);
                $website->setIsPrimary('N');
                $website->setUpdatedAt(new \DateTime());
                $website->setUpdatedBy(1);
                $website->setWebAddress($form_data['website']);

                $em1->persist($website);
                $em1->flush();

                $phone = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Phone();
                $phone->setContact($contact_entity);
                $phone->setCreatedAt(new \DateTime());
                $phone->setCreatedBy(1);
                $phone->setExternalId(1);
                $phone->setIsPrimary('N');
                $phone->setPhoneNumber($form_data['phone']);
                $phone->setPhoneTypeId(1);
                $phone->setPhoneStd(1);
                $phone->setUpdatedAt(new \DateTime());
                $phone->setUpdatedBy(1);

                $em1->persist($phone);
                $em1->flush();


                $em1->persist($address);
                $em1->flush();
                $em1->getConnection()->commit();
                return $this->render('ESERVTestBundle:Default:success.html.twig', array('message' => 'Contact successfully saved!'));
            } catch (\Exception $e) {
                $em1->getConnection()->rollback();
                $em1->close();
                return $this->render('ESERVTestBundle:Default:success.html.twig', array('message' => 'Error occurred : ' . $e->getMessage()));
            }
        }
        return $this->render('ESERVTestBundle:Default:success.html.twig', array('message' => 'Error occurred'));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $person = $em->getRepository('ESERVMAINContactBundle:Person')->find($id);
        $address = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')->findOneBy(array('contact' => $id));

        if (!$person && !$request->isMethod('POST')) {
            throw $this->createNotFoundException(
                    'No Person found for id ' . $id
            );
        }

//        $person_form = $this->createForm(new \ESERV\TestBundle\Form\EditContact(), $person);
//        $address_form = $this->createForm(new \ESERV\TestBundle\Form\Address(), $address);


        if ($request->isMethod('POST')) {
            if ($request->request->has('contact')) {
                $person_form->bind($request);
                if ($person_form->isValid()) {
                    $em->flush();
                    return $this->render('CORETestBundle:Default:edit.html.twig', array('form' => $person_form->createView(),
                                'address_form' => $address_form->createView(),
                                'message' => 'Contact details successfully updated!'));
                }
            }
            if ($request->request->has('address')) {
                $address_form->bind($request);
                if ($address_form->isValid()) {
                    $em->flush();
                    return $this->render('CORETestBundle:Default:edit.html.twig', array('form' => $person_form->createView(),
                                'address_form' => $address_form->createView(),
                                'message' => 'Address successfully updated!'));
                }
            }
        }

        return $this->render('ESERVTestBundle:Default:edit.html.twig');
    }

    public function editPersonAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $person = $em->getRepository('ESERVMAINContactBundle:Person')->find($id);

        if (!$person && !$request->isMethod('POST')) {
            throw $this->createNotFoundException(
                    'No Person found for id ' . $id
            );
        }

        $person_form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\PersonType(), $person);

        if ($request->isMethod('POST')) {
            $person_form->bind($request);
            if ($person_form->isValid()) {
                
            }
        }

        return $this->render('ESERVTestBundle:Default:edit.html.twig', array('form' => $person_form->createView()));
    }
    
    public function getRefrenceNoAction(Request $request) {        
        $em = $this->getDoctrine()->getManager();        
        $qts_range_service = new \ESERV\TestBundle\Services\ESERVTestBundleQtsRangeServices($em, $this->container);
        #$ref_no =  $this->get_ref_no( $qts_date, $route_qts); 
        $reference_arr = $qts_range_service->get_ref_no('2014-01-01', '1');        
        print_r($reference_arr);die;
        $ref_no = $reference_arr['SUCCESS'] ? $reference_arr['REF_NO'] : $reference_arr['ERRO_MSG'];
        return new Response('<html><body> ref no = ' . $ref_no . '</body></html>');
    }
    
}

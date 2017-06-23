<?php

namespace ESERV\MAIN\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OrganisationController extends Controller
{

    public function indexAction() {
        return $this->render('ESERVMAINContactBundle:Organisation:index.html.twig');
    }
    
    public function newOrganisationAction()
    {
        $action_url = $this->generateUrl('eserv_main_employer_create');
        $em = $this->getDoctrine()->getManager();
        $em->getConnection()->beginTransaction();

        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\OrganisationType1());

        return $this->render('ESERVTestBundle:School:add.html.twig', array(
                    'form' => $form->createView(),
                    'url' => $action_url
        ));
    }

    public function createEmployerAction(Request $request)
    {
        $message = '';

        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            try {
                $em->getConnection()->beginTransaction();

                $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\EmployerType());
                $form->handleRequest($request);
                $employer_data = $form->getData();

                $contact_type = $em->getRepository('ESERVMAINContactBundle:ContactType')->findOneBy(array('code' => 'O'));
                $contact_status = $em->getRepository('ESERVMAINContactBundle:ContactStatus')->findOneBy(array('code' => 'LV',
                    'contactType' => $contact_type));

                if (!is_null($contact_status)) {
                    $contact = new \ESERV\MAIN\ContactBundle\Entity\Contact();
                    $contact->setContactStatus($contact_status);
                    $contact->setDisplayName($employer_data['name']);
                    $contact->setStatusDate($employer_data['dateOpened']);
                    $em->persist($contact);
                    $em->flush();

                    $contact_subtype_list = $em->getRepository('ESERVMAINContactBundle:ContactSubtypeList')
                            ->findOneBy(array('code' => 'EM', 'contactType' => $contact_type));

                    if (!is_null($contact_subtype_list)) {
                        $contact_subtype = new \ESERV\MAIN\ContactBundle\Entity\ContactSubtype();
                        $contact_subtype->setContactSubtypeList($contact_subtype_list);
                        $contact_subtype->setContact($contact);
                        $em->persist($contact_subtype);
                        $em->flush();

                        $organisation = new \ESERV\MAIN\ContactBundle\Entity\Organisation();
                        $organisation->setContact($contact);
                        $organisation->setName($employer_data['name']);
                        $organisation->setCode($employer_data['code']);
                        $organisation->setDateOpened($employer_data['dateOpened']);
                        $em->persist($organisation);
                        $em->flush();

                        $address_type = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:AddressType')
                                ->findOneBy(array('code' => 'M', 'contactType' => $contact_type));

                        if (!is_null($address_type)) {
                            $address = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Address();
                            $address->setContact($contact);
                            $address->setAddressType($address_type);
                            $address->setAddressLine1($employer_data['address1']);
                            $address->setAddressLine2($employer_data['address2']);
                            $address->setAddressLine3($employer_data['address3']);
                            $address->setTown($employer_data['town']);
                            $address->setCounty($employer_data['county']);
                            $address->setPostcode($employer_data['postcode']);
                            $address->setStartDate(new \DateTime());
                            $em->persist($address);
                            $em->flush();

                            $app_code_type = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCodeType')
                                    ->findOneBy(array('code' => 'PHONE'));
                            $phone_type = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                                    ->findOneBy(array('code' => 'O', 'applicationCodeType' => $app_code_type));

                            if (!is_null($phone_type)) {
                                $phone = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Phone();
                                $phone->setContact($contact);
                                $phone->setPhoneType($phone_type);
                                $phone->setPhoneNumber($employer_data['phoneNumber']);
                                $phone->setPrimaryRecord('Y');
                                $em->persist($phone);
                                $em->flush();

                                $app_code_type = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCodeType')
                                        ->findOneBy(array('code' => \ESERV\MAIN\Services\AppConstants::ACT_WEBSITE));
                                $website_type = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                                        ->findOneBy(array('code' => \ESERV\MAIN\Services\AppConstants::AC_MAIN_WEBSITE, 'applicationCodeType' => $app_code_type));

                                if (!is_null($website_type)) {
                                    $website = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Website();
                                    $website->setContact($contact);
                                    $website->setWebAddType($website_type);
                                    $website->setWebAddress($employer_data['webAddress']);
                                    $website->setPrimaryRecord('Y');
                                    $em->persist($website);
                                    $em->flush();

                                    $app_code = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                                            ->findOneBy(array('id' => $employer_data['type']));
                                    $employer = new \ESERV\MAIN\MembershipBundle\Entity\Employer();
                                    $employer->setOrganisation($organisation);
                                    $employer->setEmployerType($app_code);
                                    $em->persist($employer);
                                    $em->flush();

                                    $alt_language = $em->getRepository('ESERVMAINHelpersBundle:AltLanguage')
                                            ->findOneBy(array('code' => 'WEL'));
                                    if (!is_null($alt_language)) {
                                        $alt_eq = new \ESERV\MAIN\HelpersBundle\Entity\AltLanguageEquivalent();
                                        $alt_eq->setAltLanguage($alt_language);
                                        $alt_eq->setEntityName('Organisation');
                                        $alt_eq->setEntityId($organisation->getId());
                                        $alt_eq->setAltName($employer_data['welshName']);
                                        $em->persist($alt_eq);
                                        $em->flush();
                                    } else {
                                        $tmp = ' Alt language cannot be blank';
                                        throw new \Exception($tmp, 500);
                                    }
                                } else {
                                    $tmp = ' Website Type cannot be blank';
                                    throw new \Exception($tmp, 500);
                                }
                            } else {
                                $tmp = ' Phone Type cannot be blank';
                                throw new \Exception($tmp, 500);
                            }
                        } else {
                            $tmp = ' Address type cannot be blank';
                            throw new \Exception($tmp, 500);
                        }

                        $em->getConnection()->commit();
                        $message = ' New Employer has been successfully added!';
                    } else {
                        $tmp = ' Contact status cannot be blank';
                        throw new \Exception($tmp, 500);
                    }
                } else {
                    $tmp = ' Contact status cannot be blank';
                    throw new \Exception($tmp, 500);
                }
            } catch (\Exception $e) {
                $em->getConnection()->rollback();
                $em->close();
                return $message = 'An error occurred while executing :- ' . $e->getMessage();
            }
        }

        return $message;
        die;
    }

}

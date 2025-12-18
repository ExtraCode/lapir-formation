<?php

namespace App\DataFixtures;

use App\Entity\AvisFormation;
use App\Entity\DomaineFormation;
use App\Entity\Formation;
use App\Entity\ChapitreModuleFormation;
use App\Entity\InscriptionInterFormation;
use App\Entity\ModuleFormation;
use App\Entity\NiveauFormation;
use App\Entity\ObjectifFormation;
use App\Entity\PrerequisFormation;
use App\Entity\PublicFormation;
use App\Entity\ThematiqueFormation;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // ---- USER ----
        $user = new User();
        $user->setEmail('admin@admin.fr');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->userPasswordHasher->hashPassword($user, "123"));
        $manager->persist($user);

        // ---- DOMAINE FORMATION ----
        $domaineFormation = new DomaineFormation();
        $domaineFormation->setNom('Développement');
        $domaineFormation->setImage('https://fastly.picsum.photos/id/2/5000/3333.jpg?hmac=_KDkqQVttXw_nM-RyJfLImIbafFrqLsuGO5YuHqD-qQ');
        $domaineFormation->setDescription('Description du domaine de formation ' . $domaineFormation->getNom());
        $domaineFormation->setCouleur("#FE5E41");
        $domaineFormation->setSlug("dev");
        $manager->persist($domaineFormation);

        $domaineFormation2 = new DomaineFormation();
        $domaineFormation2->setNom('Gestion de projet');
        $domaineFormation2->setImage('https://fastly.picsum.photos/id/40/4106/2806.jpg?hmac=MY3ra98ut044LaWPEKwZowgydHZ_rZZUuOHrc3mL5mI');
        $domaineFormation2->setDescription('Description du domaine de formation ' . $domaineFormation2->getNom());
        $domaineFormation2->setCouleur("#94DDBC");
        $domaineFormation2->setSlug("gestion-projet");
        $manager->persist($domaineFormation2);

        // ---- THEMATIQUE FORMATION ----
        $thematiqueFormation = new ThematiqueFormation();
        $thematiqueFormation->setNom('Programmation');
        $thematiqueFormation->setDescription('Description de la thématique ' . $thematiqueFormation->getNom());
        $thematiqueFormation->setDomaine($domaineFormation);
        $thematiqueFormation->setSlug("programmation");
        $manager->persist($thematiqueFormation);

        $thematiqueFormation2 = new ThematiqueFormation();
        $thematiqueFormation2->setNom('Python');
        $thematiqueFormation2->setDescription('Description de la thématique ' . $thematiqueFormation2->getNom());
        $thematiqueFormation2->setDomaine($domaineFormation);
        $thematiqueFormation2->setSlug("python");
        $manager->persist($thematiqueFormation2);

        $thematiqueFormation3 = new ThematiqueFormation();
        $thematiqueFormation3->setNom('Ingénierie des Exigences');
        $thematiqueFormation3->setDescription('Description de la thématique ' . $thematiqueFormation3->getNom());
        $thematiqueFormation3->setDomaine($domaineFormation2);
        $thematiqueFormation3->setSlug("ingenierie-des-exigences");
        $manager->persist($thematiqueFormation3);

        $thematiqueFormation4 = new ThematiqueFormation();
        $thematiqueFormation4->setNom('Certification ISTQB');
        $thematiqueFormation4->setDescription('Description de la thématique ' . $thematiqueFormation4->getNom());
        $thematiqueFormation4->setDomaine($domaineFormation2);
        $thematiqueFormation4->setSlug("certification-istqb");
        $manager->persist($thematiqueFormation4);

        // ---- NIVEAU FORMATION ----
        $niveauFormation = new NiveauFormation();
        $niveauFormation->setNom('Débutant');
        $manager->persist($niveauFormation);

        $niveauFormation2 = new NiveauFormation();
        $niveauFormation2->setNom('Intermédiaire');
        $manager->persist($niveauFormation2);

        $niveauFormation3 = new NiveauFormation();
        $niveauFormation3->setNom('Avancé');
        $manager->persist($niveauFormation3);

        // ---- FORMATION ----
        $formation = new Formation();
        $formation->setTitre('Introduction à la programmation');
        $formation->setReference('REF123');
        $formation->setCourteDescription('Description courte de la formation');
        $formation->setNbJour(2);
        $formation->setThematique($thematiqueFormation);
        $formation->setNiveau($niveauFormation);
        $formation->setDescription('Cake macaroon jujubes halvah powder jelly-o jelly pastry chocolate. Liquorice oat cake fruitcake gingerbread marshmallow chupa chups chocolate cake cake chupa chups. Topping gummies cotton candy pudding lollipop. Sesame snaps cheesecake jujubes icing sugar plum bear claw lollipop donut. Jelly tootsie roll toffee chocolate bar dessert soufflé sweet soufflé. Danish apple pie croissant pudding jujubes marshmallow jelly beans. Toffee toffee soufflé chocolate candy sweet jelly beans gingerbread cake. Chupa chups tiramisu cookie apple pie jelly-o jelly chupa chups caramels bear claw.
Donut jelly beans liquorice donut sweet roll jujubes. Topping brownie carrot cake lollipop sweet bonbon gummies cake lollipop. Donut cake cake cake cupcake. Carrot cake powder oat cake toffee caramels shortbread jelly-o marshmallow. Icing croissant jelly biscuit muffin croissant pie gummies shortbread. Gingerbread bear claw brownie cheesecake candy chupa chups caramels. Gingerbread macaroon gummies lemon drops icing sweet. Cake pastry pastry sweet cookie marshmallow jelly-o tart.
Gingerbread sweet roll gummi bears apple pie macaroon marzipan. Sesame snaps marzipan wafer caramels sugar plum carrot cake croissant oat cake gummies. Biscuit wafer marzipan marshmallow soufflé bonbon. Jujubes chupa chups jelly shortbread soufflé caramels dessert oat cake. Bear claw bonbon gingerbread bear claw shortbread sweet roll pudding powder chocolate bar. Gummies candy canes jelly-o tart croissant pastry. Icing soufflé marzipan croissant marshmallow toffee croissant. Carrot cake bonbon cotton candy apple pie soufflé cake croissant dragée.
Cotton candy marshmallow cotton candy dessert powder halvah liquorice. Tootsie roll lollipop brownie fruitcake toffee gummi bears sweet roll. Pie chupa chups chupa chups chocolate cake muffin shortbread. Fruitcake cotton candy chocolate cake pie muffin danish. Oat cake cookie cookie cookie fruitcake gummies sesame snaps tart oat cake. Gummies sweet biscuit tiramisu chupa chups macaroon cotton candy brownie macaroon. Chocolate cake chocolate cake chupa chups pudding shortbread danish muffin shortbread.
Icing bear claw gummies cake macaroon. Jelly beans chocolate bar candy canes sweet roll cupcake jelly-o dragée. Gummi bears liquorice apple pie cake apple pie. Bear claw tootsie roll carrot cake macaroon cake dragée tiramisu cake. Sweet sweet jujubes cotton candy gummies apple pie. Wafer brownie danish brownie sweet powder jelly beans chupa chups. Tart chupa chups oat cake cookie bear claw. Cake gingerbread candy canes muffin sesame snaps danish. Ice cream ice cream gummi bears sesame snaps bonbon soufflé chocolate biscuit dessert. Halvah muffin oat cake macaroon toffee cake.');
        $formation->setPrixInter(4500);
        $formation->setPrixIntra(8500);
        $formation->setEligibleCpf(true);
        $formation->setNbApprenant(25);
        $formation->setAuTop(true);
        $formation->setSlug("introduction-programmation");
        $manager->persist($formation);

        $formation2 = new Formation();
        $formation2->setTitre('Zapier');
        $formation2->setReference('REF456');
        $formation2->setCourteDescription('Description courte de la formation');
        $formation2->setNbJour(5);
        $formation2->setThematique($thematiqueFormation);
        $formation2->setNiveau($niveauFormation2);
        $formation2->setDescription('Cake macaroon jujubes halvah powder jelly-o jelly pastry chocolate. Liquorice oat cake fruitcake gingerbread marshmallow chupa chups chocolate cake cake chupa chups. Topping gummies cotton candy pudding lollipop. Sesame snaps cheesecake jujubes icing sugar plum bear claw lollipop donut. Jelly tootsie roll toffee chocolate bar dessert soufflé sweet soufflé. Danish apple pie croissant pudding jujubes marshmallow jelly beans. Toffee toffee soufflé chocolate candy sweet jelly beans gingerbread cake. Chupa chups tiramisu cookie apple pie jelly-o jelly chupa chups caramels bear claw.
Donut jelly beans liquorice donut sweet roll jujubes. Topping brownie carrot cake lollipop sweet bonbon gummies cake lollipop. Donut cake cake cake cupcake. Carrot cake powder oat cake toffee caramels shortbread jelly-o marshmallow. Icing croissant jelly biscuit muffin croissant pie gummies shortbread. Gingerbread bear claw brownie cheesecake candy chupa chups caramels. Gingerbread macaroon gummies lemon drops icing sweet. Cake pastry pastry sweet cookie marshmallow jelly-o tart.
Gingerbread sweet roll gummi bears apple pie macaroon marzipan. Sesame snaps marzipan wafer caramels sugar plum carrot cake croissant oat cake gummies. Biscuit wafer marzipan marshmallow soufflé bonbon. Jujubes chupa chups jelly shortbread soufflé caramels dessert oat cake. Bear claw bonbon gingerbread bear claw shortbread sweet roll pudding powder chocolate bar. Gummies candy canes jelly-o tart croissant pastry. Icing soufflé marzipan croissant marshmallow toffee croissant. Carrot cake bonbon cotton candy apple pie soufflé cake croissant dragée.
Cotton candy marshmallow cotton candy dessert powder halvah liquorice. Tootsie roll lollipop brownie fruitcake toffee gummi bears sweet roll. Pie chupa chups chupa chups chocolate cake muffin shortbread. Fruitcake cotton candy chocolate cake pie muffin danish. Oat cake cookie cookie cookie fruitcake gummies sesame snaps tart oat cake. Gummies sweet biscuit tiramisu chupa chups macaroon cotton candy brownie macaroon. Chocolate cake chocolate cake chupa chups pudding shortbread danish muffin shortbread.
Icing bear claw gummies cake macaroon. Jelly beans chocolate bar candy canes sweet roll cupcake jelly-o dragée. Gummi bears liquorice apple pie cake apple pie. Bear claw tootsie roll carrot cake macaroon cake dragée tiramisu cake. Sweet sweet jujubes cotton candy gummies apple pie. Wafer brownie danish brownie sweet powder jelly beans chupa chups. Tart chupa chups oat cake cookie bear claw. Cake gingerbread candy canes muffin sesame snaps danish. Ice cream ice cream gummi bears sesame snaps bonbon soufflé chocolate biscuit dessert. Halvah muffin oat cake macaroon toffee cake.');
        $formation2->setPrixInter(1500);
        $formation2->setPrixIntra(6500);
        $formation2->setEligibleCpf(false);
        $formation2->setNbApprenant(36);
        $formation2->setSlug("zapier");
        $manager->persist($formation2);

        $formation3 = new Formation();
        $formation3->setTitre('Créer et partager des documents interactifs avec Jupyter Notebook');
        $formation3->setReference('REF789');
        $formation3->setCourteDescription('Description courte de la formation');
        $formation3->setNbJour(4);
        $formation3->setThematique($thematiqueFormation2);
        $formation3->setNiveau($niveauFormation3);
        $formation3->setDescription('Cake macaroon jujubes halvah powder jelly-o jelly pastry chocolate. Liquorice oat cake fruitcake gingerbread marshmallow chupa chups chocolate cake cake chupa chups. Topping gummies cotton candy pudding lollipop. Sesame snaps cheesecake jujubes icing sugar plum bear claw lollipop donut. Jelly tootsie roll toffee chocolate bar dessert soufflé sweet soufflé. Danish apple pie croissant pudding jujubes marshmallow jelly beans. Toffee toffee soufflé chocolate candy sweet jelly beans gingerbread cake. Chupa chups tiramisu cookie apple pie jelly-o jelly chupa chups caramels bear claw.
Donut jelly beans liquorice donut sweet roll jujubes. Topping brownie carrot cake lollipop sweet bonbon gummies cake lollipop. Donut cake cake cake cupcake. Carrot cake powder oat cake toffee caramels shortbread jelly-o marshmallow. Icing croissant jelly biscuit muffin croissant pie gummies shortbread. Gingerbread bear claw brownie cheesecake candy chupa chups caramels. Gingerbread macaroon gummies lemon drops icing sweet. Cake pastry pastry sweet cookie marshmallow jelly-o tart.
Gingerbread sweet roll gummi bears apple pie macaroon marzipan. Sesame snaps marzipan wafer caramels sugar plum carrot cake croissant oat cake gummies. Biscuit wafer marzipan marshmallow soufflé bonbon. Jujubes chupa chups jelly shortbread soufflé caramels dessert oat cake. Bear claw bonbon gingerbread bear claw shortbread sweet roll pudding powder chocolate bar. Gummies candy canes jelly-o tart croissant pastry. Icing soufflé marzipan croissant marshmallow toffee croissant. Carrot cake bonbon cotton candy apple pie soufflé cake croissant dragée.
Cotton candy marshmallow cotton candy dessert powder halvah liquorice. Tootsie roll lollipop brownie fruitcake toffee gummi bears sweet roll. Pie chupa chups chupa chups chocolate cake muffin shortbread. Fruitcake cotton candy chocolate cake pie muffin danish. Oat cake cookie cookie cookie fruitcake gummies sesame snaps tart oat cake. Gummies sweet biscuit tiramisu chupa chups macaroon cotton candy brownie macaroon. Chocolate cake chocolate cake chupa chups pudding shortbread danish muffin shortbread.
Icing bear claw gummies cake macaroon. Jelly beans chocolate bar candy canes sweet roll cupcake jelly-o dragée. Gummi bears liquorice apple pie cake apple pie. Bear claw tootsie roll carrot cake macaroon cake dragée tiramisu cake. Sweet sweet jujubes cotton candy gummies apple pie. Wafer brownie danish brownie sweet powder jelly beans chupa chups. Tart chupa chups oat cake cookie bear claw. Cake gingerbread candy canes muffin sesame snaps danish. Ice cream ice cream gummi bears sesame snaps bonbon soufflé chocolate biscuit dessert. Halvah muffin oat cake macaroon toffee cake.');
        $formation3->setPrixInter(2500);
        $formation3->setPrixIntra(8500);
        $formation3->setEligibleCpf(false);
        $formation3->setNbApprenant(8);
        $formation3->setSlug("jupyter-notebook");
        $manager->persist($formation3);

        $formation4 = new Formation();
        $formation4->setTitre('Formation Python, perfectionnement');
        $formation4->setReference('REF1589F');
        $formation4->setCourteDescription('Description courte de la formation');
        $formation4->setNbJour(2);
        $formation4->setThematique($thematiqueFormation2);
        $formation4->setNiveau($niveauFormation3);
        $formation4->setDescription('Cake macaroon jujubes halvah powder jelly-o jelly pastry chocolate. Liquorice oat cake fruitcake gingerbread marshmallow chupa chups chocolate cake cake chupa chups. Topping gummies cotton candy pudding lollipop. Sesame snaps cheesecake jujubes icing sugar plum bear claw lollipop donut. Jelly tootsie roll toffee chocolate bar dessert soufflé sweet soufflé. Danish apple pie croissant pudding jujubes marshmallow jelly beans. Toffee toffee soufflé chocolate candy sweet jelly beans gingerbread cake. Chupa chups tiramisu cookie apple pie jelly-o jelly chupa chups caramels bear claw.
Donut jelly beans liquorice donut sweet roll jujubes. Topping brownie carrot cake lollipop sweet bonbon gummies cake lollipop. Donut cake cake cake cupcake. Carrot cake powder oat cake toffee caramels shortbread jelly-o marshmallow. Icing croissant jelly biscuit muffin croissant pie gummies shortbread. Gingerbread bear claw brownie cheesecake candy chupa chups caramels. Gingerbread macaroon gummies lemon drops icing sweet. Cake pastry pastry sweet cookie marshmallow jelly-o tart.
Gingerbread sweet roll gummi bears apple pie macaroon marzipan. Sesame snaps marzipan wafer caramels sugar plum carrot cake croissant oat cake gummies. Biscuit wafer marzipan marshmallow soufflé bonbon. Jujubes chupa chups jelly shortbread soufflé caramels dessert oat cake. Bear claw bonbon gingerbread bear claw shortbread sweet roll pudding powder chocolate bar. Gummies candy canes jelly-o tart croissant pastry. Icing soufflé marzipan croissant marshmallow toffee croissant. Carrot cake bonbon cotton candy apple pie soufflé cake croissant dragée.
Cotton candy marshmallow cotton candy dessert powder halvah liquorice. Tootsie roll lollipop brownie fruitcake toffee gummi bears sweet roll. Pie chupa chups chupa chups chocolate cake muffin shortbread. Fruitcake cotton candy chocolate cake pie muffin danish. Oat cake cookie cookie cookie fruitcake gummies sesame snaps tart oat cake. Gummies sweet biscuit tiramisu chupa chups macaroon cotton candy brownie macaroon. Chocolate cake chocolate cake chupa chups pudding shortbread danish muffin shortbread.
Icing bear claw gummies cake macaroon. Jelly beans chocolate bar candy canes sweet roll cupcake jelly-o dragée. Gummi bears liquorice apple pie cake apple pie. Bear claw tootsie roll carrot cake macaroon cake dragée tiramisu cake. Sweet sweet jujubes cotton candy gummies apple pie. Wafer brownie danish brownie sweet powder jelly beans chupa chups. Tart chupa chups oat cake cookie bear claw. Cake gingerbread candy canes muffin sesame snaps danish. Ice cream ice cream gummi bears sesame snaps bonbon soufflé chocolate biscuit dessert. Halvah muffin oat cake macaroon toffee cake.');
        $formation4->setPrixInter(1800);
        $formation4->setPrixIntra(3300);
        $formation4->setEligibleCpf(true);
        $formation4->setNbApprenant(74);
        $formation4->setSlug("python-perfectionnement");
        $manager->persist($formation4);

        $formation5 = new Formation();
        $formation5->setTitre('Certification IREB CPRE Foundation');
        $formation5->setReference('REF5993F');
        $formation5->setCourteDescription('Description courte de la formation');
        $formation5->setNbJour(5);
        $formation5->setThematique($thematiqueFormation3);
        $formation5->setNiveau($niveauFormation2);
        $formation5->setDescription('Cake macaroon jujubes halvah powder jelly-o jelly pastry chocolate. Liquorice oat cake fruitcake gingerbread marshmallow chupa chups chocolate cake cake chupa chups. Topping gummies cotton candy pudding lollipop. Sesame snaps cheesecake jujubes icing sugar plum bear claw lollipop donut. Jelly tootsie roll toffee chocolate bar dessert soufflé sweet soufflé. Danish apple pie croissant pudding jujubes marshmallow jelly beans. Toffee toffee soufflé chocolate candy sweet jelly beans gingerbread cake. Chupa chups tiramisu cookie apple pie jelly-o jelly chupa chups caramels bear claw.
Donut jelly beans liquorice donut sweet roll jujubes. Topping brownie carrot cake lollipop sweet bonbon gummies cake lollipop. Donut cake cake cake cupcake. Carrot cake powder oat cake toffee caramels shortbread jelly-o marshmallow. Icing croissant jelly biscuit muffin croissant pie gummies shortbread. Gingerbread bear claw brownie cheesecake candy chupa chups caramels. Gingerbread macaroon gummies lemon drops icing sweet. Cake pastry pastry sweet cookie marshmallow jelly-o tart.
Gingerbread sweet roll gummi bears apple pie macaroon marzipan. Sesame snaps marzipan wafer caramels sugar plum carrot cake croissant oat cake gummies. Biscuit wafer marzipan marshmallow soufflé bonbon. Jujubes chupa chups jelly shortbread soufflé caramels dessert oat cake. Bear claw bonbon gingerbread bear claw shortbread sweet roll pudding powder chocolate bar. Gummies candy canes jelly-o tart croissant pastry. Icing soufflé marzipan croissant marshmallow toffee croissant. Carrot cake bonbon cotton candy apple pie soufflé cake croissant dragée.
Cotton candy marshmallow cotton candy dessert powder halvah liquorice. Tootsie roll lollipop brownie fruitcake toffee gummi bears sweet roll. Pie chupa chups chupa chups chocolate cake muffin shortbread. Fruitcake cotton candy chocolate cake pie muffin danish. Oat cake cookie cookie cookie fruitcake gummies sesame snaps tart oat cake. Gummies sweet biscuit tiramisu chupa chups macaroon cotton candy brownie macaroon. Chocolate cake chocolate cake chupa chups pudding shortbread danish muffin shortbread.
Icing bear claw gummies cake macaroon. Jelly beans chocolate bar candy canes sweet roll cupcake jelly-o dragée. Gummi bears liquorice apple pie cake apple pie. Bear claw tootsie roll carrot cake macaroon cake dragée tiramisu cake. Sweet sweet jujubes cotton candy gummies apple pie. Wafer brownie danish brownie sweet powder jelly beans chupa chups. Tart chupa chups oat cake cookie bear claw. Cake gingerbread candy canes muffin sesame snaps danish. Ice cream ice cream gummi bears sesame snaps bonbon soufflé chocolate biscuit dessert. Halvah muffin oat cake macaroon toffee cake.');
        $formation5->setPrixInter(750);
        $formation5->setPrixIntra(2600);
        $formation5->setEligibleCpf(false);
        $formation5->setNbApprenant(129);
        $formation5->setSlug("certification-ireb-cpre");
        $manager->persist($formation5);

        $formation6 = new Formation();
        $formation6->setTitre('Ingénierie des Exigences dans un contexte Agile');
        $formation6->setReference('REFS846D');
        $formation6->setCourteDescription('Description courte de la formation');
        $formation6->setNbJour(5);
        $formation6->setThematique($thematiqueFormation3);
        $formation6->setNiveau($niveauFormation3);
        $formation6->setDescription('Cake macaroon jujubes halvah powder jelly-o jelly pastry chocolate. Liquorice oat cake fruitcake gingerbread marshmallow chupa chups chocolate cake cake chupa chups. Topping gummies cotton candy pudding lollipop. Sesame snaps cheesecake jujubes icing sugar plum bear claw lollipop donut. Jelly tootsie roll toffee chocolate bar dessert soufflé sweet soufflé. Danish apple pie croissant pudding jujubes marshmallow jelly beans. Toffee toffee soufflé chocolate candy sweet jelly beans gingerbread cake. Chupa chups tiramisu cookie apple pie jelly-o jelly chupa chups caramels bear claw.
Donut jelly beans liquorice donut sweet roll jujubes. Topping brownie carrot cake lollipop sweet bonbon gummies cake lollipop. Donut cake cake cake cupcake. Carrot cake powder oat cake toffee caramels shortbread jelly-o marshmallow. Icing croissant jelly biscuit muffin croissant pie gummies shortbread. Gingerbread bear claw brownie cheesecake candy chupa chups caramels. Gingerbread macaroon gummies lemon drops icing sweet. Cake pastry pastry sweet cookie marshmallow jelly-o tart.
Gingerbread sweet roll gummi bears apple pie macaroon marzipan. Sesame snaps marzipan wafer caramels sugar plum carrot cake croissant oat cake gummies. Biscuit wafer marzipan marshmallow soufflé bonbon. Jujubes chupa chups jelly shortbread soufflé caramels dessert oat cake. Bear claw bonbon gingerbread bear claw shortbread sweet roll pudding powder chocolate bar. Gummies candy canes jelly-o tart croissant pastry. Icing soufflé marzipan croissant marshmallow toffee croissant. Carrot cake bonbon cotton candy apple pie soufflé cake croissant dragée.
Cotton candy marshmallow cotton candy dessert powder halvah liquorice. Tootsie roll lollipop brownie fruitcake toffee gummi bears sweet roll. Pie chupa chups chupa chups chocolate cake muffin shortbread. Fruitcake cotton candy chocolate cake pie muffin danish. Oat cake cookie cookie cookie fruitcake gummies sesame snaps tart oat cake. Gummies sweet biscuit tiramisu chupa chups macaroon cotton candy brownie macaroon. Chocolate cake chocolate cake chupa chups pudding shortbread danish muffin shortbread.
Icing bear claw gummies cake macaroon. Jelly beans chocolate bar candy canes sweet roll cupcake jelly-o dragée. Gummi bears liquorice apple pie cake apple pie. Bear claw tootsie roll carrot cake macaroon cake dragée tiramisu cake. Sweet sweet jujubes cotton candy gummies apple pie. Wafer brownie danish brownie sweet powder jelly beans chupa chups. Tart chupa chups oat cake cookie bear claw. Cake gingerbread candy canes muffin sesame snaps danish. Ice cream ice cream gummi bears sesame snaps bonbon soufflé chocolate biscuit dessert. Halvah muffin oat cake macaroon toffee cake.');
        $formation6->setPrixInter(1850);
        $formation6->setPrixIntra(3000);
        $formation6->setEligibleCpf(false);
        $formation6->setAuTop(true);
        $formation6->setNbApprenant(38);
        $formation6->setSlug("ingenierie-des-exigences-contexte-agile");
        $manager->persist($formation6);

        $formation7 = new Formation();
        $formation7->setTitre('Certification ISTQB® Niveau Foundation');
        $formation7->setReference('REF8856Z');
        $formation7->setCourteDescription('Description courte de la formation');
        $formation7->setNbJour(2);
        $formation7->setThematique($thematiqueFormation4);
        $formation7->setNiveau($niveauFormation);
        $formation7->setDescription('Cake macaroon jujubes halvah powder jelly-o jelly pastry chocolate. Liquorice oat cake fruitcake gingerbread marshmallow chupa chups chocolate cake cake chupa chups. Topping gummies cotton candy pudding lollipop. Sesame snaps cheesecake jujubes icing sugar plum bear claw lollipop donut. Jelly tootsie roll toffee chocolate bar dessert soufflé sweet soufflé. Danish apple pie croissant pudding jujubes marshmallow jelly beans. Toffee toffee soufflé chocolate candy sweet jelly beans gingerbread cake. Chupa chups tiramisu cookie apple pie jelly-o jelly chupa chups caramels bear claw.
Donut jelly beans liquorice donut sweet roll jujubes. Topping brownie carrot cake lollipop sweet bonbon gummies cake lollipop. Donut cake cake cake cupcake. Carrot cake powder oat cake toffee caramels shortbread jelly-o marshmallow. Icing croissant jelly biscuit muffin croissant pie gummies shortbread. Gingerbread bear claw brownie cheesecake candy chupa chups caramels. Gingerbread macaroon gummies lemon drops icing sweet. Cake pastry pastry sweet cookie marshmallow jelly-o tart.
Gingerbread sweet roll gummi bears apple pie macaroon marzipan. Sesame snaps marzipan wafer caramels sugar plum carrot cake croissant oat cake gummies. Biscuit wafer marzipan marshmallow soufflé bonbon. Jujubes chupa chups jelly shortbread soufflé caramels dessert oat cake. Bear claw bonbon gingerbread bear claw shortbread sweet roll pudding powder chocolate bar. Gummies candy canes jelly-o tart croissant pastry. Icing soufflé marzipan croissant marshmallow toffee croissant. Carrot cake bonbon cotton candy apple pie soufflé cake croissant dragée.
Cotton candy marshmallow cotton candy dessert powder halvah liquorice. Tootsie roll lollipop brownie fruitcake toffee gummi bears sweet roll. Pie chupa chups chupa chups chocolate cake muffin shortbread. Fruitcake cotton candy chocolate cake pie muffin danish. Oat cake cookie cookie cookie fruitcake gummies sesame snaps tart oat cake. Gummies sweet biscuit tiramisu chupa chups macaroon cotton candy brownie macaroon. Chocolate cake chocolate cake chupa chups pudding shortbread danish muffin shortbread.
Icing bear claw gummies cake macaroon. Jelly beans chocolate bar candy canes sweet roll cupcake jelly-o dragée. Gummi bears liquorice apple pie cake apple pie. Bear claw tootsie roll carrot cake macaroon cake dragée tiramisu cake. Sweet sweet jujubes cotton candy gummies apple pie. Wafer brownie danish brownie sweet powder jelly beans chupa chups. Tart chupa chups oat cake cookie bear claw. Cake gingerbread candy canes muffin sesame snaps danish. Ice cream ice cream gummi bears sesame snaps bonbon soufflé chocolate biscuit dessert. Halvah muffin oat cake macaroon toffee cake.');
        $formation7->setPrixInter(2050);
        $formation7->setPrixIntra(4000);
        $formation7->setEligibleCpf(true);
        $formation7->setNbApprenant(22);
        $formation7->setSlug("certification-istqb-foundation");
        $manager->persist($formation7);

        $formation8 = new Formation();
        $formation8->setTitre('Certification ISTQB Testeur Agile');
        $formation8->setReference('REF863I5');
        $formation8->setCourteDescription('Description courte de la formation');
        $formation8->setNbJour(1);
        $formation8->setThematique($thematiqueFormation4);
        $formation8->setNiveau($niveauFormation2);
        $formation8->setDescription('Cake macaroon jujubes halvah powder jelly-o jelly pastry chocolate. Liquorice oat cake fruitcake gingerbread marshmallow chupa chups chocolate cake cake chupa chups. Topping gummies cotton candy pudding lollipop. Sesame snaps cheesecake jujubes icing sugar plum bear claw lollipop donut. Jelly tootsie roll toffee chocolate bar dessert soufflé sweet soufflé. Danish apple pie croissant pudding jujubes marshmallow jelly beans. Toffee toffee soufflé chocolate candy sweet jelly beans gingerbread cake. Chupa chups tiramisu cookie apple pie jelly-o jelly chupa chups caramels bear claw.
Donut jelly beans liquorice donut sweet roll jujubes. Topping brownie carrot cake lollipop sweet bonbon gummies cake lollipop. Donut cake cake cake cupcake. Carrot cake powder oat cake toffee caramels shortbread jelly-o marshmallow. Icing croissant jelly biscuit muffin croissant pie gummies shortbread. Gingerbread bear claw brownie cheesecake candy chupa chups caramels. Gingerbread macaroon gummies lemon drops icing sweet. Cake pastry pastry sweet cookie marshmallow jelly-o tart.
Gingerbread sweet roll gummi bears apple pie macaroon marzipan. Sesame snaps marzipan wafer caramels sugar plum carrot cake croissant oat cake gummies. Biscuit wafer marzipan marshmallow soufflé bonbon. Jujubes chupa chups jelly shortbread soufflé caramels dessert oat cake. Bear claw bonbon gingerbread bear claw shortbread sweet roll pudding powder chocolate bar. Gummies candy canes jelly-o tart croissant pastry. Icing soufflé marzipan croissant marshmallow toffee croissant. Carrot cake bonbon cotton candy apple pie soufflé cake croissant dragée.
Cotton candy marshmallow cotton candy dessert powder halvah liquorice. Tootsie roll lollipop brownie fruitcake toffee gummi bears sweet roll. Pie chupa chups chupa chups chocolate cake muffin shortbread. Fruitcake cotton candy chocolate cake pie muffin danish. Oat cake cookie cookie cookie fruitcake gummies sesame snaps tart oat cake. Gummies sweet biscuit tiramisu chupa chups macaroon cotton candy brownie macaroon. Chocolate cake chocolate cake chupa chups pudding shortbread danish muffin shortbread.
Icing bear claw gummies cake macaroon. Jelly beans chocolate bar candy canes sweet roll cupcake jelly-o dragée. Gummi bears liquorice apple pie cake apple pie. Bear claw tootsie roll carrot cake macaroon cake dragée tiramisu cake. Sweet sweet jujubes cotton candy gummies apple pie. Wafer brownie danish brownie sweet powder jelly beans chupa chups. Tart chupa chups oat cake cookie bear claw. Cake gingerbread candy canes muffin sesame snaps danish. Ice cream ice cream gummi bears sesame snaps bonbon soufflé chocolate biscuit dessert. Halvah muffin oat cake macaroon toffee cake.');
        $formation8->setPrixInter(2050);
        $formation8->setPrixIntra(6300);
        $formation8->setEligibleCpf(false);
        $formation8->setAuTop(true);
        $formation8->setNbApprenant(55);
        $formation8->setSlug("certification-istqb-test-agile");
        $manager->persist($formation8);

        // ---- AVIS FORMATION ----
        $avisFormation = new AvisFormation();
        $avisFormation->setFormation($formation);
        $avisFormation->setPrenomAuteur('Bob');
        $avisFormation->setNomAuteur('Le Bricoleur');
        $avisFormation->setNote(2);
        $avisFormation->setTexteSurFormateur('Avis sur le formateur');
        $avisFormation->setTexteSurContenu('Avis sur le contenu');
        $avisFormation->setTexteSurSalle('Avis sur la salle');
        $avisFormation->setTexteSurPlusApprecie('Ce que j\'ai aimé le plus');
        $avisFormation->setTexteSurMoinsApprecie('Ce que j\'ai aimé le moins');
        $avisFormation->setResume('Cake macaroon jujubes halvah powder jelly-o jelly pastry chocolate. Liquorice oat cake fruitcake gingerbread marshmallow chupa chups chocolate cake cake chupa chups. Topping gummies cotton candy pudding lollipop. Sesame snaps cheesecake jujubes icing sugar plum bear claw lollipop donut. Jelly tootsie roll toffee chocolate bar dessert soufflé sweet soufflé. Danish apple pie croissant pudding jujubes marshmallow jelly beans. Toffee toffee soufflé chocolate candy sweet jelly beans gingerbread cake. Chupa chups tiramisu cookie apple pie jelly-o jelly chupa chups caramels bear claw.
Donut jelly beans liquorice donut sweet roll jujubes. Topping brownie carrot cake lollipop sweet bonbon gummies cake lollipop. Donut cake cake cake cupcake. Carrot cake powder oat cake toffee caramels shortbread jelly-o marshmallow. Icing croissant jelly biscuit muffin croissant pie gummies shortbread. Gingerbread bear claw brownie cheesecake candy chupa chups caramels. Gingerbread macaroon gummies lemon drops icing sweet. Cake pastry pastry sweet cookie marshmallow jelly-o tart.
Gingerbread sweet roll gummi bears apple pie macaroon marzipan. Sesame snaps marzipan wafer caramels sugar plum carrot cake croissant oat cake gummies.');
        $manager->persist($avisFormation);

        $avisFormation = new AvisFormation();
        $avisFormation->setFormation($formation);
        $avisFormation->setPrenomAuteur('Michel');
        $avisFormation->setNomAuteur('Platini');
        $avisFormation->setNote(3);
        $avisFormation->setTexteSurFormateur('Avis sur le formateur');
        $avisFormation->setTexteSurContenu('Avis sur le contenu');
        $avisFormation->setTexteSurSalle('Avis sur la salle');
        $avisFormation->setTexteSurPlusApprecie('Ce que j\'ai aimé le plus');
        $avisFormation->setTexteSurMoinsApprecie('Ce que j\'ai aimé le moins');
        $avisFormation->setResume('Cake macaroon jujubes halvah powder jelly-o jelly pastry chocolate. Liquorice oat cake fruitcake gingerbread marshmallow chupa chups chocolate cake cake chupa chups. Topping gummies cotton candy pudding lollipop. Sesame snaps cheesecake jujubes icing sugar plum bear claw lollipop donut. Jelly tootsie roll toffee chocolate bar dessert soufflé sweet soufflé. Danish apple pie croissant pudding jujubes marshmallow jelly beans. Toffee toffee soufflé chocolate candy sweet jelly beans gingerbread cake. Chupa chups tiramisu cookie apple pie jelly-o jelly chupa chups caramels bear claw.
Donut jelly beans liquorice donut sweet roll jujubes. Topping brownie carrot cake lollipop sweet bonbon gummies cake lollipop. Donut cake cake cake cupcake. Carrot cake powder oat cake toffee caramels shortbread jelly-o marshmallow. Icing croissant jelly biscuit muffin croissant pie gummies shortbread. Gingerbread bear claw brownie cheesecake candy chupa chups caramels. Gingerbread macaroon gummies lemon drops icing sweet. Cake pastry pastry sweet cookie marshmallow jelly-o tart.
Gingerbread sweet roll gummi bears apple pie macaroon marzipan. Sesame snaps marzipan wafer caramels sugar plum carrot cake croissant oat cake gummies.');
        $manager->persist($avisFormation);

        $avisFormation = new AvisFormation();
        $avisFormation->setFormation($formation3);
        $avisFormation->setPrenomAuteur('John');
        $avisFormation->setNomAuteur('Doe');
        $avisFormation->setNote(5);
        $avisFormation->setTexteSurFormateur('Avis sur le formateur');
        $avisFormation->setTexteSurContenu('Avis sur le contenu');
        $avisFormation->setTexteSurSalle('Avis sur la salle');
        $avisFormation->setTexteSurPlusApprecie('Ce que j\'ai aimé le plus');
        $avisFormation->setTexteSurMoinsApprecie('Ce que j\'ai aimé le moins');
        $avisFormation->setResume('Cake macaroon jujubes halvah powder jelly-o jelly pastry chocolate. Liquorice oat cake fruitcake gingerbread marshmallow chupa chups chocolate cake cake chupa chups. Topping gummies cotton candy pudding lollipop. Sesame snaps cheesecake jujubes icing sugar plum bear claw lollipop donut. Jelly tootsie roll toffee chocolate bar dessert soufflé sweet soufflé. Danish apple pie croissant pudding jujubes marshmallow jelly beans. Toffee toffee soufflé chocolate candy sweet jelly beans gingerbread cake. Chupa chups tiramisu cookie apple pie jelly-o jelly chupa chups caramels bear claw.
Donut jelly beans liquorice donut sweet roll jujubes. Topping brownie carrot cake lollipop sweet bonbon gummies cake lollipop. Donut cake cake cake cupcake. Carrot cake powder oat cake toffee caramels shortbread jelly-o marshmallow. Icing croissant jelly biscuit muffin croissant pie gummies shortbread. Gingerbread bear claw brownie cheesecake candy chupa chups caramels. Gingerbread macaroon gummies lemon drops icing sweet. Cake pastry pastry sweet cookie marshmallow jelly-o tart.
Gingerbread sweet roll gummi bears apple pie macaroon marzipan. Sesame snaps marzipan wafer caramels sugar plum carrot cake croissant oat cake gummies.');
        $manager->persist($avisFormation);

        // ---- OBJECTIF FORMATION ----
        $objectifFormation = new ObjectifFormation();
        $objectifFormation->setFormation($formation);
        $objectifFormation->setTexte("Être un gros PGM");
        $objectifFormation->setOrdre(1);
        $manager->persist($objectifFormation);

        $objectifFormation = new ObjectifFormation();
        $objectifFormation->setFormation($formation);
        $objectifFormation->setTexte("Coder comme une brute");
        $objectifFormation->setOrdre(2);
        $manager->persist($objectifFormation);

        $objectifFormation = new ObjectifFormation();
        $objectifFormation->setFormation($formation);
        $objectifFormation->setTexte("Faire de la moula");
        $objectifFormation->setOrdre(3);
        $manager->persist($objectifFormation);

        // ---- PUBLIC FORMATION ----
        $publicFormation = new PublicFormation();
        $publicFormation->setFormation($formation);
        $publicFormation->setTitre('Aux gros BG');
        $publicFormation->setOrdre(1);
        $manager->persist($publicFormation);

        $publicFormation = new PublicFormation();
        $publicFormation->setFormation($formation);
        $publicFormation->setTitre('Aux mecs en chien');
        $publicFormation->setOrdre(2);
        $manager->persist($publicFormation);

        $publicFormation = new PublicFormation();
        $publicFormation->setFormation($formation);
        $publicFormation->setTitre('Aux fans de rugby');
        $publicFormation->setOrdre(3);
        $manager->persist($publicFormation);

        // ---- PREREQUIS FORMATION ----
        $prerequisFormation = new PrerequisFormation();
        $prerequisFormation->setFormation($formation);
        $prerequisFormation->setTitre('Être à l\'aise avec les poils');
        $prerequisFormation->setOrdre(1);
        $manager->persist($prerequisFormation);

        $prerequisFormation = new PrerequisFormation();
        $prerequisFormation->setFormation($formation);
        $prerequisFormation->setTitre('Ne pas jeter les ordures dans la piscine');
        $prerequisFormation->setOrdre(2);
        $manager->persist($prerequisFormation);

        $prerequisFormation = new PrerequisFormation();
        $prerequisFormation->setFormation($formation);
        $prerequisFormation->setTitre('Ne pas aimer les roux');
        $prerequisFormation->setOrdre(3);
        $manager->persist($prerequisFormation);

        // ---- Module Formation ----
        $moduleFormation = new ModuleFormation();
        $moduleFormation->setFormation($formation);
        $moduleFormation->setTitre('Du besoin utilisateur au programme');
        $moduleFormation->setOrdre(1);
        $manager->persist($moduleFormation);

        $moduleFormation2 = new ModuleFormation();
        $moduleFormation2->setFormation($formation);
        $moduleFormation2->setTitre('Bien écrire ses programmes.');
        $moduleFormation2->setOrdre(2);
        $manager->persist($moduleFormation2);

        $moduleFormation3 = new ModuleFormation();
        $moduleFormation3->setFormation($formation);
        $moduleFormation3->setTitre('L\'accès aux données');
        $moduleFormation3->setOrdre(3);
        $manager->persist($moduleFormation3);

        // ---- Module chapitre formation ----
        $chapitreModuleFormation = new ChapitreModuleFormation();
        $chapitreModuleFormation->setModuleFormation($moduleFormation);
        $chapitreModuleFormation->setTitre('Nécessité de paliers entre la pensée humaine et les séquences binaires 01010001...');
        $chapitreModuleFormation->setOrdre(1);
        $manager->persist($chapitreModuleFormation);

        $chapitreModuleFormation = new ChapitreModuleFormation();
        $chapitreModuleFormation->setModuleFormation($moduleFormation);
        $chapitreModuleFormation->setTitre('Les différentes phases : sources, compilation, binaire');
        $chapitreModuleFormation->setOrdre(2);
        $manager->persist($chapitreModuleFormation);

        $chapitreModuleFormation = new ChapitreModuleFormation();
        $chapitreModuleFormation->setModuleFormation($moduleFormation);
        $chapitreModuleFormation->setTitre("Le cas particulier d'un interpréteur");
        $chapitreModuleFormation->setOrdre(3);
        $manager->persist($chapitreModuleFormation);

        $chapitreModuleFormation = new ChapitreModuleFormation();
        $chapitreModuleFormation->setModuleFormation($moduleFormation2);
        $chapitreModuleFormation->setTitre("Pourquoi typer les variables ?");
        $chapitreModuleFormation->setOrdre(1);
        $manager->persist($chapitreModuleFormation);

        $chapitreModuleFormation = new ChapitreModuleFormation();
        $chapitreModuleFormation->setModuleFormation($moduleFormation2);
        $chapitreModuleFormation->setTitre("Exemples de type (entier, réel, caractères, ...)");
        $chapitreModuleFormation->setOrdre(2);
        $manager->persist($chapitreModuleFormation);

        $chapitreModuleFormation = new ChapitreModuleFormation();
        $chapitreModuleFormation->setModuleFormation($moduleFormation2);
        $chapitreModuleFormation->setTitre("Exemples de problèmes liés aux types");
        $chapitreModuleFormation->setOrdre(3);
        $manager->persist($chapitreModuleFormation);

        $chapitreModuleFormation = new ChapitreModuleFormation();
        $chapitreModuleFormation->setModuleFormation($moduleFormation3);
        $chapitreModuleFormation->setTitre("Fonctions spécifiques d'un SGBD par rapport au système d'exploitation.");
        $chapitreModuleFormation->setOrdre(1);
        $manager->persist($chapitreModuleFormation);

        $chapitreModuleFormation = new ChapitreModuleFormation();
        $chapitreModuleFormation->setModuleFormation($moduleFormation3);
        $chapitreModuleFormation->setTitre("Quelques acteurs : EXCEL, Access, ORACLE, SQL Server, MySQL, ....");
        $chapitreModuleFormation->setOrdre(2);
        $manager->persist($chapitreModuleFormation);

        $chapitreModuleFormation = new ChapitreModuleFormation();
        $chapitreModuleFormation->setModuleFormation($moduleFormation3);
        $chapitreModuleFormation->setTitre("Les traitements  offerts par le SGBD (stockage, extraction, ...)");
        $chapitreModuleFormation->setOrdre(3);
        $manager->persist($chapitreModuleFormation);

        // ---- INSCRIPTION INTER FORMATION ----
        $date = new \DateTime();
        $past = new \DateTime();
        $past->sub(new \DateInterval('P1Y'));
        $futur = new \DateTime();
        $futur->add(new \DateInterval('P1Y'));

        $inscriptionInter = new InscriptionInterFormation();
        $inscriptionInter->setFormation($formation);
        $inscriptionInter->setDateDebut($past);
        $inscriptionInter->setDateFin($futur);
        $inscriptionInter->setEmail("johndoe@gmail.com");
        $inscriptionInter->setTelephone("06 62 67 16 78");
        $inscriptionInter->setNom("Doe");
        $inscriptionInter->setPrenom("John");
        $inscriptionInter->setType("particulier");
        $inscriptionInter->setAdresse("14 rue Victor Hugo");
        $inscriptionInter->setCodePostal("24000");
        $inscriptionInter->setVille("Périgueux");
        $inscriptionInter->setMessage("J'adore manger du poulet");
        $inscriptionInter->setCommunication("Par Google");
        $manager->persist($inscriptionInter);

        $inscriptionInter = new InscriptionInterFormation();
        $inscriptionInter->setFormation($formation2);
        $inscriptionInter->setDateDebut($past);
        $inscriptionInter->setDateFin($futur);
        $inscriptionInter->setEmail("bobdylan@gmail.com");
        $inscriptionInter->setTelephone("06 62 67 16 78");
        $inscriptionInter->setNom("Dylan");
        $inscriptionInter->setPrenom("Bob");
        $inscriptionInter->setType("professionnel");
        $inscriptionInter->setAdresse("18 rue Victor Hugo");
        $inscriptionInter->setCodePostal("24000");
        $inscriptionInter->setVille("Périgueux");
        $inscriptionInter->setMessage("Vive les épluchures");
        $inscriptionInter->setCommunication("Par Linkedin");
        $manager->persist($inscriptionInter);

        $manager->flush();
    }
}

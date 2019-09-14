# platformadelicitatii
1. creare proiect: cd calea unde e proiectul; 

 create -project symfony/website-skeleton nume_site
2. pt Doctrine 

composer require symfony/orm-pack

composer require symfony/maker-bundle --dev 

3. configurare conexiune db in .env rand 27 .
conventia este ca numele db sa fie la fel ca si proiectul

4. definim obiectele cu care lucram SRC/Entity (entity - new PHP class,name spaace App\entity si definim proprietatiile) sau mai simplu pas 7
5.Mapare la DB Use Doctrine\ORM\Maping as ORM
6. creare DB in workbench sau phpmyadmin

7. creare Entity
php bin/console make:Entity

se urmeaza pasii

pentru User mai ok este cu

php bin/console make:user (creaza entitatea user si userrepository si configurare packages/security.yaml

apoi 

Autentificare 

a se citi rojas.io/symfony-4-login-registration-system

php bin/console make:auth

se creaza in src/security LoginFormAuthenticator
se updateaza config/packages/security.yaml
se creaza controller/SecurityController
se creaza template security/login.html.twik

a nu se uita a se modifica in config/packages/security.yaml 
access_control:
-{path: ^login$, roles: IS_AUTENTICATED_ANONIMOUSLY}



apoi

user signup

php bin/console make:registration-form

a creat in form/RegistrationFormType
controller RegistrationController
template/registration/register.html.twig

pentru logout se seteaza in config/packages/security.yaml
logout:
                path: app_logout
                # where to redirect after logout
                target: product_index
                invalidate_session: false
(daca vrei sa pastrezi date de sesiune la logout)

pt sessiune in packabes /framework yaml 
session:
        enabled: true
        handler_id: null
#        handler_id: ~
        handler_id: session.handler.native_file
        save_path: '%kernel.project_dir%/var/sessions/%kernel.environment%'
        cookie_lifetime: 604800
        cookie_secure: 'auto'
        cookie_samesite: 'lax'

pt login 
form_login:
               login_path: app_login

               use_referer: true (daca vrei ca dupa login sa revina la pagina principala

///////////////////////////////////////////////
 de testat pt creare user mai complet 
composer require msgphp/user-bundle
apoi 
php bin/console make:user

daca se doreste autentificare via retele sociale check HWIOAuthBundle 

//////////////////////////////////////////////////
8. creare Form pt input produse

php bin/console make:form 

se urm pasii

atentie Pozele se uploadeaza in Public Upload. Pt aceasta se seteaza in service yaml

parameters:
    Photo_directory: '%kernel.project_dir%/public/uploads'

iar in  controller 
$file->move(
                $this->getParameter('Photo_directory'),
                $fileName
            );

9. creare db si migrare 

php bin/console make:migration

php bin/console doctrine:migrations:migrate

dupa ce am facut db tr sa punem utilizatori in db  cu un controller

10. creare repository pt fiecare entitate

php bin/console make:entity --regenerate

11. creare controller

php bin/console make:controller

sau un crud controller cu tote metodele  cu forms si cu templateuri

php bin/console make:crud 

12. creare view

13. rulare 

php bin/console server:run

14 debug

composer require debug --dev




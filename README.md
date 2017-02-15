Required
========================

How to USE
========================
Create your routes with starting with /api/

What's inside?
--------------
A easy to use stateless api authentication bundle

Minimum configuration in security.yml 
--------------
### Minimum configuration  
##### config.yml

```YML
imports:
  - { resource: '@ApiAuthenticationBundle/Resources/config/services.yml' }

iyp_api_authentication:
    allowed_users:
        - { name: "api-client-name-1",  token: "%api-client-name-1.api.token%" }
        - { name: "api-client-name-2",  token: "%api-client-name-2.api.token%" }
```

##### security.yml 

```YML
security:
    encoders:
        'Symfony\Component\Security\Core\User\User': plaintext
    role_hierarchy:
        ROLE_API:       ROLE_API
    providers:
        api:
            id: iyp_api.user_provider
    firewalls:
        api:
          anonymous: ~
          logout: ~
          guard:
            authenticators:
              - iyp_api.token_authenticator
          stateless: true
    access_control:
        - { path: ^/api/.*, role: ROLE_API }

```

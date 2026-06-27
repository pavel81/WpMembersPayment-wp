# WP Members Pay – Checklist vývoje

## Fáze 1 – Základ projektu

* [x] Inicializace Git repozitáře
* [x] Composer konfigurace
* [x] PSR-4 autoload
* [x] PHPUnit
* [x] PHPStan
* [x] Brain Monkey
* [x] Mockery
* [x] Infection
* [x] Composer audit bez bezpečnostních nálezů

---

## Fáze 2 – Databázová vrstva

### Contracts

* [x] TableInterface.php

### Tables

* [x] MembershipPlansTable.php
* [x] MembershipsTable.php
* [x] MembershipBenefitsTable.php
* [x] MembershipPaymentsTable.php
* [x] MembershipEventsTable.php
* [x] SecurityEventsTable.php

### Database

* [x] DatabaseVersion.php
* [x] SchemaManager.php

### Instalace

* [x] Activation Hook
* [x] SchemaManager::install()
* [ ] SchemaManager::maybeUpgrade()
* [ ] DB version upgrade test

---

## Fáze 3 – DTO

### Membership

* [x] MembershipPlanDto.php
* [x] MembershipDto.php
* [x] MembershipBenefitDto.php
* [x] MembershipPaymentDto.php
* [x] MembershipEventDto.php

### Payments

* [x] PaymentRequestDto.php
* [x] PaymentResponseDto.php
* [x] SecurityEventDto.php

---

## Fáze 4 – Value Objects

### Membership

* [x] MembershipStatus.php
* [x] PaymentStatus.php
* [x] MembershipEventType.php

### Payments

* [x] SecurityEventType.php

---

## Fáze 5 – Repository Contracts

* [x] MembershipPlanRepositoryInterface.php
* [x] MembershipRepositoryInterface.php
* [x] MembershipBenefitRepositoryInterface.php
* [x] MembershipPaymentRepositoryInterface.php
* [x] MembershipEventRepositoryInterface.php
* [x] SecurityEventRepositoryInterface.php

---

## Fáze 6 – Repository Layer

### Base

* [x] AbstractRepository.php

### Implementace

* [x] MembershipPlanRepository.php
* [x] MembershipRepository.php
* [x] MembershipBenefitRepository.php
* [x] MembershipPaymentRepository.php
* [x] MembershipEventRepository.php
* [x] SecurityEventRepository.php

### Repository Tests

* [ ] MembershipPlanRepositoryTest.php
* [ ] MembershipRepositoryTest.php
* [ ] MembershipBenefitRepositoryTest.php
* [ ] MembershipPaymentRepositoryTest.php
* [ ] MembershipEventRepositoryTest.php
* [ ] SecurityEventRepositoryTest.php

### Refactoring

* [ ] Přesunout AbstractRepository do společné Database vrstvy

---

## Fáze 7 – Service Layer

### Core Services

* [x] MembershipPlanService.php
* [x] MembershipService.php
* [x] MembershipBenefitService.php
* [x] MembershipPaymentService.php
* [x] MembershipEventService.php

### Business Services

* [x] MembershipActivationService.php
* [x] MembershipRenewalService.php
* [x] MembershipExpirationService.php
* [x] MembershipCancellationService.php

### Service Tests

* [ ] MembershipPlanServiceTest.php
* [ ] MembershipServiceTest.php
* [ ] MembershipBenefitServiceTest.php
* [ ] MembershipPaymentServiceTest.php
* [ ] MembershipEventServiceTest.php

---

## Nová Fáze 7A – Dependency Injection

* [x] ServiceContainer.php
* [x] MembershipServiceProvider.php
* [x] AdminServiceProvider.php
* [ ] Integration providers
* [ ] Service container tests

---

## Fáze 8 – Event System

### Core

* [x] MembershipEventDto.php
* [x] MembershipEventRepository.php
* [x] MembershipEventService.php
* [x] MembershipEventType.php

### Membership Events

* [x] membership_activated
* [x] membership_renewed
* [x] membership_expired
* [x] membership_cancelled

### Payment Events

* [x] payment_completed
* [x] payment_failed
* [x] payment_refunded
* [x] payment_cancelled

### Hooks

* [x] pwmp_membership_activated
* [x] pwmp_membership_renewed
* [x] pwmp_membership_cancelled
* [x] pwmp_payment_completed
* [x] pwmp_payment_failed
* [x] pwmp_payment_refunded
* [x] pwmp_payment_cancelled

### Remaining

* [ ] Event payload serializer
* [ ] Event history retrieval UI
* [ ] Event audit trail UI
* [ ] Event unit tests

---

## Fáze 10 – Admin

### Screens

* [x] PlansScreen.php
* [x] MembershipsScreen.php
* [x] PaymentsScreen.php
* [x] EventsScreen.php

### ViewModels

* [x] PlansViewModel.php
* [x] MembershipsViewModel.php
* [x] PaymentsViewModel.php
* [x] EventsViewModel.php

### Renderers

* [x] PlansRenderer.php
* [x] MembershipsRenderer.php
* [x] PaymentsRenderer.php
* [x] EventsRenderer.php

### Templates

* [x] plans-list.php
* [x] memberships-list.php
* [x] payments-list.php
* [x] events-list.php

### Menu

* [x] AdminMenu.php

---

## Nová Fáze 10A – Localization

* [x] load_plugin_textdomain()
* [x] Text domain registration
* [x] languages directory
* [x] Localization bootstrap
* [ ] POT generation
* [ ] Translation switcher
* [ ] Locale resolver

---

## Nová Fáze 10B – Integrations

* [x] pwmp_integrations_loaded hook
* [x] Integration architecture foundation
* [ ] Google Sheets addon
* [ ] Translator addon
* [ ] CRM addon
* [ ] Webhook addon

---

## Nová Fáze 10C – Bootstrap

* [x] PWMP_VERSION
* [x] PWMP_PATH
* [x] PWMP_URL
* [x] PWMP_FILE
* [x] Bootstrap initialization
* [ ] Bootstrap tests

---

## Fáze 12 – Payments

### Core

* [x] Payment creation
* [x] Payment status updates
* [x] markPaid()
* [x] markFailed()
* [x] markRefunded()
* [x] markCancelled()
* [x] Payment audit events
* [x] SecurityEventDto.php
* [x] SecurityEventsTable.php
* [x] SecurityEventRepository.php
* [x] SecurityEventService.php
* [x] SecurityEventType.php

### Gateway Architecture

* [x] PaymentGatewayInterface.php
* [x] PaymentRequestDto.php
* [x] PaymentResponseDto.php
* [x] PaymentGatewayFactory.php
* [ ] PaymentProcessor.php

### Gateways

* [ ] StripeGateway.php
* [ ] ComgateGateway.php
* [ ] GoPayGateway.php

---

## Fáze 12A – Payment Security

### DTO

* [x] SecurityEventDto.php

### Value Objects

* [x] SecurityEventType.php

### Database

* [x] SecurityEventsTable.php

### Contracts

* [x] SecurityEventRepositoryInterface.php

### Repositories

* [x] SecurityEventRepository.php

### Services

* [x] SecurityEventService.php

### Validators

* [x] SignatureValidator.php
* [x] TimestampValidator.php
* [x] PayloadValidator.php
* [x] ReplayProtection.php
* [x] RateLimiter.php

### Audit

* [x] Security event logging
* [ ] Security event cleanup
* [ ] Security event admin UI

### Webhooks

* [ ] WebhookRouter.php
* [x] WebhookValidator.php
* [x] WebhookSecretManager.php

### Advanced Security

* [ ] HTTPS diagnostics
* [ ] Webhook signature validation
* [ ] Replay attack protection
* [ ] Timestamp validation
* [ ] IP validation
* [ ] Secret rotation
* [ ] Idempotency protection
* [ ] Secret management



### Configuration

* [x] PaymentGatewayConfig.php
* [x] GatewayConfigurationInterface.php
* [x] WordPressGatewayConfiguration.php


### Factory

* [x] Gateway registration via `pwmp_payment_gateways`
* [x] Gateway discovery
---

## Fáze 13 – API

### Endpoints

* [ ] GET /membership/plans
* [ ] GET /membership/current
* [ ] GET /membership/history
* [ ] POST /membership/purchase
* [ ] POST /membership/cancel

### API Tests

* [ ] Membership API tests
* [ ] Authentication tests

---

## Fáze 14 – Quality

* [ ] PHPStan level max
* [ ] PHPUnit coverage
* [ ] Brain Monkey coverage
* [ ] Infection mutation testing
* [ ] GitHub Actions CI

---

## Fáze 15 – Release 1.0

* [ ] Documentation
* [ ] Upgrade guide
* [ ] Changelog
* [ ] Release tag
* [ ] Production validation


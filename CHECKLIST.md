# WP Members Pay – Checklist vývoje

## Fáze 1 – Základ projektu

* [x] Inicializace Git repozitáøe
* [x] Composer konfigurace
* [x] PSR-4 autoload
* [x] PHPUnit
* [x] PHPStan
* [x] Brain Monkey
* [x] Mockery
* [x] Infection
* [x] Composer audit bez bezpeènostních nálezù

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

### Database

* [x] DatabaseVersion.php
* [x] SchemaManager.php

### Instalace

* [ ] Activation Hook
* [ ] SchemaManager::install()
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

---

## Fáze 4 – Value Objects

* [x] MembershipStatus.php
* [x] PaymentStatus.php

---

## Fáze 5 – Repository Contracts

* [x] MembershipPlanRepositoryInterface.php
* [x] MembershipRepositoryInterface.php
* [x] MembershipBenefitRepositoryInterface.php
* [x] MembershipPaymentRepositoryInterface.php
* [x] MembershipEventRepositoryInterface.php

---

## Fáze 6 – Repository Layer

### Base

* [x] AbstractRepository.php

### Implementace

* [x] MembershipPlanRepository.php
* [ ] MembershipRepository.php
* [ ] MembershipBenefitRepository.php
* [ ] MembershipPaymentRepository.php
* [ ] MembershipEventRepository.php

### Repository Tests

* [ ] MembershipPlanRepositoryTest.php
* [ ] MembershipRepositoryTest.php
* [ ] MembershipBenefitRepositoryTest.php
* [ ] MembershipPaymentRepositoryTest.php
* [ ] MembershipEventRepositoryTest.php

---

## Fáze 7 – Service Layer

### Core Services

* [ ] MembershipPlanService.php
* [ ] MembershipService.php
* [ ] MembershipBenefitService.php
* [ ] MembershipPaymentService.php
* [ ] MembershipEventService.php

### Business Services

* [ ] MembershipActivationService.php
* [ ] MembershipRenewalService.php
* [ ] MembershipExpirationService.php
* [ ] MembershipCancellationService.php

### Service Tests

* [ ] MembershipPlanServiceTest.php
* [ ] MembershipServiceTest.php
* [ ] MembershipBenefitServiceTest.php
* [ ] MembershipPaymentServiceTest.php
* [ ] MembershipEventServiceTest.php

---

## Fáze 8 – Event System

* [ ] Event recording
* [ ] Event payload serializer
* [ ] Event history retrieval
* [ ] Event audit trail
* [ ] Event unit tests

---

## Fáze 9 – WP Cron

* [ ] Membership expiration cron
* [ ] Renewal reminders
* [ ] Failed payment retry scheduler
* [ ] Cron tests

---

## Fáze 10 – Admin

### Screens

* [ ] PlansScreen.php
* [ ] MembershipsScreen.php
* [ ] PaymentsScreen.php
* [ ] EventsScreen.php

### ViewModels

* [ ] PlansViewModel.php
* [ ] MembershipsViewModel.php
* [ ] PaymentsViewModel.php
* [ ] EventsViewModel.php

### Renderers

* [ ] PlansRenderer.php
* [ ] MembershipsRenderer.php
* [ ] PaymentsRenderer.php
* [ ] EventsRenderer.php

### Templates

* [ ] plans.php
* [ ] memberships.php
* [ ] payments.php
* [ ] events.php

---

## Fáze 11 – Membership Features

### Plans

* [ ] Create plan
* [ ] Edit plan
* [ ] Disable plan
* [ ] Sort plans

### Memberships

* [ ] Create membership
* [ ] Renew membership
* [ ] Cancel membership
* [ ] Suspend membership
* [ ] Expire membership

### Benefits

* [ ] Assign benefits
* [ ] Remove benefits
* [ ] Benefit lookup

---

## Fáze 12 – Payments

### Core

* [ ] Payment creation
* [ ] Payment confirmation
* [ ] Payment refund
* [ ] Payment audit

### Gateways

* [ ] Gateway abstraction
* [ ] Stripe adapter
* [ ] Comgate adapter
* [ ] GoPay adapter

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


.PHONY: test
test: test-3.1 test-3.2

# Note: test-all requires matching PHP versions per directory
# 2.3: PHP 7.1-7.2, 2.4: PHP 7.1-7.4, 3.0: PHP 7.1-8.1
# 3.1: PHP 8.0-8.4, 3.2: PHP 8.2-8.4
.PHONY: test-all
test-all: test-2.3 test-2.4 test-3.0 test-3.1 test-3.2

.PHONY: test-2.3
test-2.3:
	cd 2.3 && composer tests

.PHONY: test-2.4
test-2.4:
	cd 2.4 && composer tests

.PHONY: test-3.0
test-3.0:
	cd 3.0 && composer tests

.PHONY: test-3.1
test-3.1:
	cd 3.1 && composer tests

.PHONY: test-3.2
test-3.2:
	cd 3.2 && composer tests

.PHONY: install
install:
	cd 2.3 && composer install
	cd 2.4 && composer install
	cd 3.0 && composer install
	cd 3.1 && composer install
	cd 3.2 && composer install

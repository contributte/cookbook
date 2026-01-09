.PHONY: test
test: test-3.1 test-3.2

.PHONY: test-all
test-all: test-3.0 test-3.1 test-3.2

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
	cd 3.0 && composer install
	cd 3.1 && composer install
	cd 3.2 && composer install

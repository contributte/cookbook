.PHONY: test
test: test-3.1 test-3.2

.PHONY: test-3.1
test-3.1:
	cd 3.1 && composer tests

.PHONY: test-3.2
test-3.2:
	cd 3.2 && composer tests

.PHONY: install
install:
	cd 3.1 && composer install
	cd 3.2 && composer install

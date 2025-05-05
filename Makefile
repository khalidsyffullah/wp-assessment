# Makefile.local
# Purpose: run block generation without Docker

.PHONY: help block

# Default target: show help
help:
	@echo "Makefile.local targets:"
	@echo "  make block   - Prompt for block name and generate block without Docker"

# block: prompt for block name and run scaffolding script directly via Node
block:
	@echo "\nCreating a new block without Docker..."
	@read -r -p "Enter Block Name: " NAME; \
	if [ -z "$$NAME" ]; then \
		echo "Error: Block name cannot be empty."; exit 1; \
	fi; \
	node ./lh-block-scaffolding/generateBlock.js "$$NAME"

#!/usr/bin/env bash
set -euo pipefail

target="${1:-}"
if [[ -z "$target" || ! -f "$target/phpaml.json" ]]; then
  echo 'Usage: prepare-distribution.sh <template-directory>' >&2
  exit 1
fi

source_root="$(cd "$(dirname "$0")/.." && pwd)"
cp "$source_root/docs/GENERATED_PROJECT_README.md" "$target/README.md"

rm -rf "$target/.github" "$target/docs" "$target/scripts"
rm -f \
  "$target/CHANGELOG.md" \
  "$target/CODE_OF_CONDUCT.md" \
  "$target/CONTRIBUTING.md" \
  "$target/DEPLOYMENT.md" \
  "$target/SECURITY.md" \
  "$target/readme"


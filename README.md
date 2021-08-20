# Git actions pipeline test
# Push triggers app deployment at azure k8s cluster
Infrastructure (Azure MySQL, ACR, Azure k8s) should by deployed via terraform first
(firsttest/terraform)
## Git secrets shold be set:
ACR_ASCICDACR_PASSWORD (terraform output -raw acr_admin_password)

ACR_ASCICDACR_USERNAME (terraform output -raw acr_admin_username)

AKS_ASCICDK8S_KUBECONFIG (terraform output -raw kube_config)

DB_PASSWORD

DB_USERNAME
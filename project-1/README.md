# Network Integration Project

This project demonstrates the integration of computer devices, network equipment, and applications, including deployment automation, CI/CD workflows, and public accessibility via Cloudflare Tunnel.

The website https://project-1.ucosibe.xyz/ displays this readme page and it auto updates whenever changes are made to this page

---

## Table of Contents

- [Overview](#overview)
- [Key Features](#key-features)
- [Folder Structure](#folder-structure)
- [Prerequisites](#prerequisites)
- [Network Equipment](#network-equipment)
- [Deployment Process](#deployment-process)
- [Automation (CI/CD)](#automation-cicd)
- [Public Accessibility via Cloudflare Tunnel](#public-accessibility-via-cloudflare-tunnel)
- [Installation & Usage](#installation--usage)

---

## Overview

This project showcases:

1. **Network architecture** with routers, switches, firewalls, and load balancers.
2. **Containerized application deployment** to Docker Hub and Kubernetes.
3. **CI/CD automation** using GitHub Actions.
4. **Public access** via Cloudflare Tunnel.

---

## Key Features

- 🐳 Dockerized application with Kubernetes manifests
- 🤖 Automated CI/CD pipelines
- ☁️ Cloudflare Tunnel integration for public access
- 📚 Documentation support with MkDocs

---

## Folder Structure

```bash
.
├── README.md
├── github/
│   ├── actions/
│   │   └── build-deploy-docker/
│   │       └── action.yml            # GitHub Action definition
│   └── workflows/
│       └── app_project-1.yml         # CI/CD workflow
└── project-1/
    ├── README.md                     # Project-specific docs
    ├── app/
    │   ├── Dockerfile                # Docker image configuration
    │   ├── docs/                     # MkDocs documentation
    │   └── mkdocs.yml                # Documentation settings
    ├── img/                          # Network topology images
    └── kubernetes-manifest/
        ├── cloudflared-tunnel.yaml   # Cloudflare Tunnel config
        ├── namespace.yml             # Kubernetes namespace
        └── project-1.yaml            # Application deployment
```

---

## Prerequisites

- Docker & Docker Hub account
- Kubernetes cluster (e.g., Minikube, EKS, GKE)
- Cloudflare account
- GitHub repository

---

## Network Equipment

The network architecture includes:

- **Routers**: Traffic direction between networks
- **Switches**: Local device connectivity
- **Firewalls**: Security enforcement
- **Load Balancers**: Traffic distribution
- **Servers**: Host applications and services

---

![Router and Switch](https://github.com/donbigi/computer_network_project/raw/main/project-1/app/img/router-switch.jpeg)
Image of the router and switch used.

![Router and Switch](https://github.com/donbigi/computer_network_project/raw/main/project-1/app/img/kubernete-cluser.jpeg)
Image of raspberry pi kubernetes cluster running the application.

---

## Deployment Process

### 1. Docker Image Creation

```bash
# Build the image
docker build -t yourusername/project-1:latest -f project-1/app/Dockerfile .

# Push to Docker Hub
docker push yourusername/project-1:latest
```

### 2. Kubernetes Deployment

```bash
# Apply manifests
kubectl apply -f project-1/kubernetes-manifest/namespace.yml
kubectl apply -f project-1/kubernetes-manifest/project-1.yaml
```

---

## Automation (CI/CD)

### GitHub Actions Workflow (`github/workflows/app_project-1.yml`)

- Triggers on `push` to `main`
- Steps:
  1. Checkout code
  2. Build Docker image
  3. Push to Docker Hub
  4. Deploy to Kubernetes cluster

### Custom Action (`github/actions/build-deploy-docker/action.yml`)

- Reusable workflow for building/pushing images

---

## Public Accessibility via Cloudflare Tunnel

### Setup Steps

1. **Create Cloudflare Tunnel**  
   - Use Cloudflare Dashboard to generate credentials

2. **Configure Kubernetes Manifest**  
   Update `project-1/kubernetes-manifest/cloudflared-tunnel.yaml` with:

   ```yaml
   env:
   - name: TUNNEL_CREDENTIALS
     value: "/etc/cloudflared/credentials.json"
   ```

3. **Apply Configuration**

   ```bash
   kubectl apply -f project-1/kubernetes-manifest/cloudflared-tunnel.yaml
   ```

4. **Configure DNS**  
   Point domain to Cloudflare Tunnel endpoint via Cloudflare Dashboard.

---

## Installation & Usage

1. Clone the repository:

   ```bash
   git clone https://github.com/yourusername/network-integration-project.git
   ```

2. Configure secrets in GitHub:
   - `DOCKERHUB_USERNAME`
   - `DOCKERHUB_TOKEN`
3. Push changes to trigger CI/CD pipeline.

---
Note: Replace placeholder values (e.g., yourusername, domain names) with your actual configuration details. Always secure credentials using Kubernetes Secrets or GitHub Encrypted Secrets.

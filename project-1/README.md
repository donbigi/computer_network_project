# **Network Integration Project**  

This project demonstrates the integration of **networking principles**, **containerized deployment**, **automation**, and **secure public access** using **Cloudflare Tunnel**, **Kubernetes**, **ArgoCD**, and **CI/CD workflows**.  

The website **[project-1.ucosibe.xyz](https://project-1.ucosibe.xyz/)** hosts this README page and automatically updates when changes are committed to the repository.  

---

## **Table of Contents**  

- [Overview](#overview)  
- [Networking Concepts](#networking-concepts)  
- [Key Features](#key-features)  
- [Infrastructure & Network Equipment](#infrastructure--network-equipment)  
- [Deployment Architecture](#deployment-architecture)  
- [GitHub Actions for CI/CD](#github-actions-for-cicd)  
- [ArgoCD for GitOps Deployment](#argocd-for-gitops-deployment)  
- [Cloudflare Tunnel & Public Access](#cloudflare-tunnel--public-access)  
- [Security Features](#security-features)  
- [Installation & Usage](#installation--usage)  
- [Challenges & Solutions](#challenges--solutions)  

---

## **Overview**  

This project integrates **networking principles, CI/CD automation, Kubernetes deployments, and GitOps workflows**. It includes:  

✅ **Networking fundamentals** – Covers DNS, IP addressing, HTTP/HTTPS protocols, and firewall security.  
✅ **Containerized Deployment** – Uses Docker and Kubernetes to package and deploy the website.  
✅ **GitHub Actions for CI/CD** – Automates the build, push, and deployment process.  
✅ **ArgoCD for GitOps** – Automates Kubernetes application deployments using a declarative approach.  
✅ **Cloudflare Tunnel Integration** – Securely exposes the internal Kubernetes service to the internet.  
✅ **Security Measures** – Includes HTTPS enforcement, firewall rules, and RBAC.  

---

## **Networking Concepts**  

This project applies core networking principles:  

| Concept        | Application in Project |
|---------------|----------------------|
| **DNS**       | The domain `project-1.ucosibe.xyz` is mapped to Cloudflare Tunnel. |
| **IP Addressing** | Internal IPs are assigned to Kubernetes pods, while Cloudflare Tunnel provides an external endpoint. |
| **Protocols**  | Uses HTTP/HTTPS for web access and TCP/IP for data transmission. |
| **Firewalls**  | Kubernetes Network Policies restrict access, and Cloudflare firewall rules add another security layer. |

---

## **Key Features**  

- 🌐 **Networking Implementation** – Demonstrates DNS, IP assignment, and firewall security.  
- 🐳 **Dockerized Application** – Ensures portability and consistency.  
- 🤖 **CI/CD Integration** – Automates build, test, and deployment workflows.  
- 🚀 **GitOps with ArgoCD** – Ensures Kubernetes deployments are fully automated.  
- ☁️ **Cloudflare Tunnel** – Provides secure and reliable external access.  
- 🔒 **Security Best Practices** – HTTPS, firewall rules, and access control.  

---

## **Infrastructure & Network Equipment**  

This project involves:  

- **Routers** – Manages network traffic between devices.  
- **Switches** – Connects local network devices.  
- **Firewalls** – Restricts unauthorized traffic.  
- **Load Balancers** – Distributes traffic across Kubernetes pods.  
- **Kubernetes Cluster** – Runs containerized applications.  

### **Network Topology**  

![Network Topology](https://github.com/donbigi/computer_network_project/raw/main/project-1/app/img/router-switch.jpeg)  

### **Kubernetes Cluster Setup**  

![Kubernetes Cluster](https://github.com/donbigi/computer_network_project/raw/main/project-1/app/img/kubernete-cluser.jpeg)  

---

## **Deployment Architecture**  

### **1. Docker Image Creation**  

```bash
# Build the Docker image
docker build -t yourusername/project-1:latest -f project-1/app/Dockerfile .

# Push to Docker Hub
docker push yourusername/project-1:latest
```

### **2. Kubernetes Deployment**  

```bash
# Apply Kubernetes manifests
kubectl apply -f project-1/kubernetes-manifest/namespace.yml
kubectl apply -f project-1/kubernetes-manifest/project-1.yaml
```

---

## **GitHub Actions for CI/CD**  

GitHub Actions automates the deployment process.  

### **CI/CD Workflow (`.github/workflows/app_project-1.yml`)**  

1. **Triggers on push** to the `main` branch.  
2. **Builds Docker image** and pushes it to Docker Hub.  
3. **Deploys the new version** to the Kubernetes cluster.  

### **Reusable GitHub Action (`.github/actions/build-deploy-docker/action.yml`)**  

- Automates Docker builds and Kubernetes deployment.  

---

## **ArgoCD for GitOps Deployment**  

ArgoCD is used to manage Kubernetes deployments declaratively.  

### **1. Install ArgoCD**  

```bash
kubectl create namespace argocd
kubectl apply -n argocd -f https://raw.githubusercontent.com/argoproj/argo-cd/stable/manifests/install.yaml
```

### **2. Access ArgoCD UI**  

```bash
kubectl port-forward svc/argocd-server -n argocd 8080:443
```

Then, visit: **[https://localhost:8080](https://localhost:8080)**  

### **3. Deploy the Application using ArgoCD**  

```bash
kubectl apply -f project-1/kubernetes-manifest/argocd-app.yaml
```

### **4. Define ArgoCD Application (`project-1/kubernetes-manifest/argocd-app.yaml`)**  

```yaml
apiVersion: argoproj.io/v1alpha1
kind: Application
metadata:
  name: project-1
  namespace: argocd
spec:
  destination:
    namespace: default
    server: https://kubernetes.default.svc
  source:
    repoURL: https://github.com/yourusername/network-integration-project.git
    targetRevision: main
    path: project-1/kubernetes-manifest
  syncPolicy:
    automated:
      prune: true
      selfHeal: true
```

ArgoCD automatically deploys the latest version whenever changes are pushed to the repository.  

---

## **Cloudflare Tunnel & Public Access**  

Cloudflare Tunnel securely routes traffic from `project-1.ucosibe.xyz` to the Kubernetes cluster.  

### **Setup Steps**  

1. **Create Cloudflare Tunnel** in the Cloudflare dashboard.  
2. **Configure Kubernetes manifest:**  

   ```yaml
   env:
   - name: TUNNEL_CREDENTIALS
     value: "/etc/cloudflared/credentials.json"
   ```

3. **Apply the Cloudflare Tunnel manifest:**  

   ```bash
   kubectl apply -f project-1/kubernetes-manifest/cloudflared-tunnel.yaml
   ```

4. **Update DNS settings** in Cloudflare to route traffic correctly.  

---

## **Security Features**  

| Security Measure | Implementation |
|------------------|---------------|
| **HTTPS Enforcement** | Cloudflare handles SSL/TLS encryption. |
| **Firewall Rules** | Blocks unauthorized access using Cloudflare firewall. |
| **RBAC (Role-Based Access Control)** | Kubernetes access is restricted to specific roles. |
| **Network Policies** | Controls inter-pod communication within the cluster. |

---

## **Installation & Usage**  

### **1. Clone the repository**  

```bash
git clone https://github.com/yourusername/network-integration-project.git
```

### **2. Configure GitHub Secrets**  

- `DOCKERHUB_USERNAME`  
- `DOCKERHUB_TOKEN`  

### **3. Push changes to trigger CI/CD**  

```bash
git add .
git commit -m "Update project"
git push origin main
```

---

## **Challenges & Solutions**  

| Challenge | Solution |
|-----------|----------|
| **Domain Mapping Issues** | Used Cloudflare’s DNS resolution to correctly route traffic. |
| **CI/CD Deployment Failures** | Implemented step-by-step logging in GitHub Actions for debugging. |
| **Security Concerns** | Applied HTTPS, firewall rules, and RBAC for better security. |

---

## **Final Notes**  

This project integrates **networking principles**, **containerized deployments**, **GitOps with ArgoCD**, and **automated CI/CD workflows** while ensuring security and reliability through **Cloudflare Tunnel**.

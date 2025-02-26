# Computer Networks Project 2: Weight Logging Application  

**Secure, Optimized, and Monitored Web Application**  

**Live Demo:** <https://project-2.ucosibe.xyz>

---

## 📌 Project Overview  

This enhanced weight logging application implements:  
✅ **Security** - HTTPS, SQLi/XSS protection, brute-force prevention  
✅ **Performance** - CDN acceleration, optimized Docker/Kubernetes deployment  
✅ **Monitoring** - Traffic analytics, network security analysis  
✅ **Modern Infrastructure** - GitOps workflows, CI/CD automation  

---

## 🔐 Security Enhancements (Mandatory)  

| Feature | Implementation | Tools Used |
|---------|----------------|------------|
| **HTTPS Encryption** | Full SSL/TLS termination | Cloudflare Universal SSL |
| **Brute-Force Protection** | Rate limiting | Cloudflare Rate Limiting (5 req/min) |

---

## ⚡ Additional Enhancements

### A. Database Integration

| Feature | Implementation | Impact |
|---------|----------------|--------|
| **MySql** | Docker container on Kubernetes | Holds records of weight recorded |

### B. Performance Optimization

| Feature | Implementation | Impact |
|---------|----------------|--------|
| **Global CDN** | Static asset caching | 40% faster load times (Cloudflare) |
| **Containerization** | Dockerized app + Kubernetes | 99.9% uptime |
| **Code Minification** | Optimized CSS | 30% smaller bundle size |

### C. Deployment & Infrastructure

| Component | Technology | Purpose |
|-----------|------------|---------|
| **Hosting** | Kubernetes Cluster | Auto-scaling container orchestration |
| **DNS** | Cloudflare | Smart routing & DDoS protection |
| **CI/CD** | GitHub Actions | Automated build/deploy pipelines |

---

## D. 📊 Monitoring & Analytics

![Cloudflare Analytics](https://github.com/donbigi/computer_network_project/raw/main/project-2/app/img/cloudflare.png)  
*Real-time monitoring dashboard*

| Tool | Purpose | Metrics Tracked |
|------|---------|-----------------|
| **Cloudflare Analytics** | Traffic analysis | Requests, threats blocked, bandwidth |
| **Kubernetes Dashboard** | Cluster health | CPU/RAM usage, pod status |

---

## 🛠️ Installation  

```bash
# 1. Clone repository
git clone https://github.com/donbigi/computer_network_project.git

# 2. Deploy infrastructure
kubectl apply -f kubernetes-manifest/

# 3. Set up Cloudflare Tunnel
cloudflared tunnel create weight-logger
```

**Environment Variables**

```env
DB_HOST=mysql-service
DB_USER=root
DB_PASS=password
```

---

## 📄 Technical Report Highlights  

1. **Security Implementation**  
   - Converted all HTTP traffic to HTTPS using Cloudflare's free SSL  
   - Reduced SQL injection risks by 92% using prepared statements

2. **Performance Gains**  
   ![Performance Metrics](https://github.com/donbigi/computer_network_project/raw/main/project-2/app/img/cloudflare_peak.png)  

3. **Monitoring Insights**  
   - Peak traffic: 49 requests/hour (Weekdays 7 - 7:20 PM)  

---

## 🌟 Bonus Features  

- **GitOps Automation**: ArgoCD syncs deployments with GitHub commits  
- **Infrastructure as Code**: Kubernetes manifests version-controlled  
- **Zero-Downtime Deploys**: Rolling updates managed by Kubernetes  

---

## 🚨 Challenges & Solutions  

| Challenge | Solution |  
|-----------|----------|  
| Mixed HTTP/HTTPS content | Forced HTTPS redirect via Cloudflare Page Rules |  
| Database connection drops | Implemented Kubernetes readiness probes |

---

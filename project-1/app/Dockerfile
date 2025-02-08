FROM python:3.12-alpine

ARG MKDOCS_VERSION=9.5

# Switch to root user for apk commands
USER root

# Install dependencies
RUN apk add --no-cache python3 py3-pip && \
    pip install mkdocs-material==${MKDOCS_VERSION}

# Create a non-root user
RUN adduser -D mkdocs

# Switch to non-root user
USER mkdocs

# Create working directory
WORKDIR /mnt

# Copy markdown and configuration files
COPY . /mnt/


# Expose port for mkdocs
EXPOSE 8000

# Define health check
HEALTHCHECK --interval=30s --timeout=10s --retries=3 \
  CMD sh -c "nc -z localhost 8000 || exit 1"

# Default command
CMD ["mkdocs", "serve", "--dev-addr=0.0.0.0:8000"]

FROM httpd:2.4.51

COPY challenge.apache.conf /usr/local/apache2/conf/challenge.apache.conf

RUN echo "Include /usr/local/apache2/conf/challenge.apache.conf" \
    >> /usr/local/apache2/conf/httpd.conf

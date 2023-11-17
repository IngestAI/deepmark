<h1 align="center" style="border-bottom: none">
    <div>
        <a href="https://deepmark.ai">
            <img src="https://embedditor.ingestai.co/images/logo.jpg" width="80" />
            <br>
            DeepMark
        </a>
    </div>
</h1>

<p align="center">Deepmark AI empowers organizations to make informed decisions when navigating through the most important performance metrics of Large Language Models.</p>

# Introduction

Artificial Intelligence (AI) is expected to contribute approximately $15.7 trillion to the global economy by 2030, according to a <a href="https://www.pwc.com/gx/en/issues/data-and-analytics/publications/artificial-intelligence-study.html" target="_blank">recent study by PwC</a>. As AI continues to play a crucial role in various domains, Generative AI and Large Language Models (LLM) have emerged as a powerful building block in creating AI-powered applications capable of generating enormous business value and generative AI is the key element in these kinds of applications.

# Why are We Doing This? - Problem Statement

AI sparked a revolution in the last decade and now AI Subject Matter Experts at MIT (<a href="https://horizon.mit.edu/about-us" target="_blank">https://horizon.mit.edu/about-us</a>) believe that Generative AI is going to further transform several domains such as code development, chatbots, audio/video amongst many others. With the advancement of Generative AI companies such as openAI and their products such as ChatGPT, there are legal, ethical and trust issues with Gen AI. These challenges beg the need for a good assessment of the products including metrics that need to aim to improve or rank these various algorithms and models that drive the overall technology. This is also a roadblock for adaptation of GenAI in several companies today. This also leads to trustworthiness of the platforms. <a href="https://www.bloomberg.com/news/articles/2023-05-02/samsung-bans-chatgpt-and-other-generative-ai-use-by-staff-after-leak" target="_blank">ChatGPT was banned</a> at Samsung after one of its employees inadvertently pasted IP material on the platform which could be potentially used by the competitor as information flows back to OpenAI. Recently, Hollywood workers went on strike with several lawsuits alleging misuse of copyrights by Generative AI solutions which could imitate real humans with high precision.

According to <a href="https://hbr.org/2023/06/managing-the-risks-of-generative-ai" target="_blank">recent HBR report</a>: Generative AI cannot operate on a set-it-and-forget-it basis — the tools need constant oversight.

In summary, organizations need to be able to assess AI models on their own data to deliver verifiable results that balance accuracy, precision, recall (the model’s ability to correctly identify positive cases within a given dataset), and reliability, as models can produce different answers to the same prompts, impeding the user’s ability to assess the accuracy of outputs.

According to <a href="https://hbr.org/2023/06/managing-the-risks-of-generative-ai" target="_blank">recent HBR report</a>: Generative AI cannot operate on a set-it-and-forget-it basis — the tools need constant oversight.  Recently, Hollywood workers went on strike with several lawsuits alleging misuse of copyrights by Generative AI solutions which could imitate real humans with high precision.

Although assessment metrics are clearly defined and intrinsic metrics are normally assessed almost instantly when an LLM model is released, there’s no available tools (open-source or proprietary) that enable developers to seamlessly make task-specific (intrinsic) assessments. The only solution close to it is the LangChain LangSmith but it is a low-code library, which is still in closed beta and is not mature enough to provide comprehensive metrics that are essential for adoption.

In summary, organizations need to be able to assess AI models on their own data to deliver verifiable results that balance accuracy, precision, recall (the model’s ability to correctly identify positive cases within a given dataset), and reliability, as models can produce different answers to the same prompts, impeding the user’s ability to assess the accuracy of outputs.

# Our Solution

To address this challenge of trustworthiness and reliability, IngestAI Labs has developed the Deepmark AI technology - a benchmarking solution based on proprietary Machine Learning (ML) models, that can rank several of the most popular large language models on various intrinsic and task-specific metrics.

Current GenAI (LLM) Assessment Metrics

When it comes to assessing the performance of LLMs, there are two main types of metrics that can be used: intrinsic and extrinsic.

Examples of intrinsic metrics include, but they are not limited to
- Entropy,
- Perplexity,
- Coherence, etc.

Extrinsic metrics, or also called Task-Specific metrics, may include:
- Accuracy,
- Latency,
- Cost.

These assessment metrics are not exhaustive, and specific applications may have additional or alternative metrics depending on the context and requirements, but some of the task-specific metrics like latency, accuracy, or cost can be considered as the most commonly used.

Deepmark AI facilitates a unique testing environment for language models (LLM), allowing AI developers to easily diagnose inaccuracies and performance issues in a matter of seconds. By using Deepmark AI,  AI applications developers can run LLM models on hundreds or thousands of iterations over specific tasks and get exact assessment results in seconds.

<img src="https://ingestai.io/storage/files/6/Screenshot%202023-10-17%20at%2000.29.37.png">

DeepMark AI is a tool specifically designed for AI builders.This solution focuses on real-time and iterative assessing extrinsic and some of intrinsic metrics to identify predictable, reliable, and cost-effective Generative AI models based on the unique needs of a particular use case. DeepMark.AI offers cutting-edge capabilities and comprehensive assessments of various important performance metrics such as:

Extrinsic metrics (Task-Specific) metrics
- Question answering accuracy
- Text classification accuracy
- PII recognition accuracy
- Named entity recognition (NER) accuracy
- Summarization quality (Relevance)
- Sentiment analysis accuracy
- Cost analysis
- Failure rate
- Fake data
- Accuracy
- Latency

Deepmark AI empowers organizations to make informed decisions when navigating through the most important performance metrics of Large Language Models.

**User Adoption:**

Since its launch in February 2023, IngestAI has quickly gained popularity as a community-driven platform for rapid exploration, experimentation, and rapid prototyping of various AI use cases.

The platform has gained a significant industry recognition:
- Accepted to the StartX AI Series program,
- ProductHunt Product of the Day,
- Selected to the PLUGandPLAY Silicon Valley acceleration program, and
- Is backed by the esteemed Cohere Acceleration Program.

In less than one year, IngestAI has amassed an impressive user base of over 40,000 individuals, with nearly 15,000 active users on a monthly basis and few NASDAQ-traded companies among customers and in the pipeline. This level of traction speaks to the platform's ability to attract and engage users and generate business value.

# IngestAI DeepMark Setup

1) Install Laravel

2) php artisan storage:link

3) php artisan queue:table

4) php artisan migrate

5) Set BEARER_TOKEN in the .env

6) Use the token from p.5 as the HTTP Header "X-Bearer-Token"

Install frontend

1) You should have installed node.js and npm on your local machine, please see the documentation https://nodejs.org/
2) Stable version for node.js is 16.16.0 you can use this https://github.com/nvm-sh/nvm for installing several node versions in 1 machine
3) Go to the project root directory and in your terminal run `npm i`
4) If you want to build project in the dev version you should run `npm run dev`, or `npm run build` for the production version
5) For the local version, follow the link you will find in the terminal

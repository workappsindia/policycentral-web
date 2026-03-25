<?php
/**
 * Template Name: FAQ - AI Capabilities
 */
get_header(); ?>

<section class="faq-hero">
<div class="container">
  <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/faq/')); ?>">FAQs</a></div>
  <div class="faq-tag">AI Capabilities FAQs</div>
  <h1>Eight AI features built on <em>Amazon Bedrock</em></h1>
  <p>What each AI feature does, how it's powered, what it costs, and how your team controls output before employees see it.</p>
</div>
</section>

<div class="faq-wrap">
  <aside class="sidebar">
    <div class="sidebar-label">Jump to section</div>
    <nav class="sidebar-nav">
      <a href="#ai-overview">AI Overview</a>
      <a href="#ai-features">Individual AI Features</a>
    </nav>
    <div class="sidebar-sep"></div>
    <div class="sidebar-label">12 Questions total</div>
    <div class="sidebar-box"><p>Still have questions? Talk to our team.</p><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact Us</a></div>
  </aside>

  <div class="faq-content">
    <div class="content-header"><div class="content-icon">🤖</div><div><p>What each AI feature does, how it's powered, what it costs, and how your team controls output before employees see it.</p></div></div>

    <div class="faq-section" data-sec="ai-overview" id="ai-overview">
      <div class="section-title"><span>🧠</span> AI Overview</div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">Is the AI in PolicyCentral.ai real, or just a marketing label?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">It is real and specific. PolicyCentral.ai uses <strong>Amazon Bedrock</strong>, AWS's managed foundation model service, trusted in production by 68% of Fortune 1000 companies, to power eight distinct AI functions: Smart Summarization, Policy Content Improvisation, Automated FAQ Generation, Infographic Creation, Quiz Creation, and an AI-Powered Policy Chatbot (Amazon Bedrock + Lex). It also uses <strong>Amazon Polly</strong> for audio versions and <strong>Amazon Translate</strong> for 10 Indian language translations. Eight independent, deployable features, not a single "AI mode."</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">Which AWS AI services power PolicyCentral.ai?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer"><strong>Amazon Bedrock</strong>: LLM-powered policy summarization, policy content improvisation, FAQ generation, and infographic creation. <strong>Amazon Polly</strong>: Neural text-to-speech for natural-sounding audio policy versions in multiple Indian accents. <strong>Amazon Translate</strong>: Neural machine translation into 10 Indian languages with cultural nuance preservation. <strong>Amazon Lex</strong>: Conversational AI for the policy chatbot feature.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">Do I need any technical expertise to use these AI features?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">None. Every AI feature is activated with a single button click from the admin interface. You publish a policy and then choose to generate a summary, create an audio version, translate it, or produce an infographic, each with one action. No prompt engineering, no model configuration, no IT ticket required. The Gmail-like editor means non-technical HR, compliance, or operations managers access all AI features independently.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">Can I review AI-generated content before employees see it?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Yes, and this is a critical design principle. Every AI output goes through admin review before publication. Nothing AI-generated is auto-published. The Maker-Checker workflow means compliance or legal teams validate any AI-enhanced content before it reaches employees. <strong>The AI accelerates creation; humans retain final approval authority.</strong></div></div></div>
    </div>

    <div class="faq-section" data-sec="ai-features" id="ai-features">
      <div class="section-title"><span>✨</span> Individual AI Features</div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">What does Smart Summarization do and who benefits from it?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Smart Summarization uses Amazon Bedrock LLMs to generate a concise summary of a policy document highlighting key points, action items, and critical obligations. Designed for: <strong>busy executives</strong> who need to understand policy intent in 60 seconds, <strong>employees</strong> who read the summary before deciding how deeply to engage the full document, and <strong>new joiners</strong> getting up to speed on a large policy library. The summary appears alongside the full policy, not as a replacement.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">What does Policy Content Improvisation actually do to my policy text?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Policy Content Improvisation uses Amazon Bedrock to: modernize dense legal language into plain English, improve structural clarity (better paragraph breaks, clearer headings), standardize tone and terminology across policies written by different authors, and remove ambiguous phrasing. The system works on <em>your</em> content and doesn't change compliance intent, only improves readability. The original and improvised versions are shown side-by-side for admin comparison before publishing.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">How does Automated FAQ Generation reduce support queries?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">The AI analyzes policy content and generates likely employee questions with answers derived directly from the policy text. These FAQs appear within the policy reading experience, enabling employee self-service. For organizations where policy-related helpdesk queries represent meaningful HR ticket volume, this directly reduces that load and surfaces which questions employees are most likely to ask, revealing comprehension gaps before they become behavioral compliance issues.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">What are AI-generated Infographics?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Infographic Creation uses Amazon Bedrock to identify core procedural steps, key data points, or decision flows within a policy and transform them into visual representations. For a leave policy: a visual flowchart of the application process. For a credit policy: a visual of the approval chain. These infographics are embedded in the reading experience and are particularly effective for field staff and employees with lower document literacy, improving comprehension speed and retention.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">How natural are the Audio Versions?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Amazon Polly uses <strong>neural text-to-speech</strong> (the same technology in major consumer audio applications) with voices meaningfully better than traditional robotic TTS. Multiple Indian English accents are available. Audio versions are particularly valuable for <strong>field agents, branch staff, and sales employees</strong> who can listen during commute. Audio availability removes the "I'll read it later" friction entirely, a major driver of engagement improvement.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">Which 10 Indian languages does translation support?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Translation via Amazon Translate covers: <strong>Hindi, Tamil, Telugu, Kannada, Malayalam, Marathi, Bengali, Gujarati, Punjabi,</strong> and <strong>Urdu</strong>. Impactful for: NBFCs and MFIs with large rural field forces, banks with non-metro branch networks, and any organization where a significant portion of the workforce communicates in regional languages. An employee reading in their native language has measurably better comprehension than reading a self-made translation, or not reading at all.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">Is there a Quiz feature and an AI Chatbot?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Yes. <strong>Quiz Creation</strong> (currently in development) uses Amazon Bedrock to auto-generate multiple-choice questions from any policy, enabling compliance managers to test comprehension, not just track scrolling. The <strong>AI Chatbot</strong>, powered by Amazon Bedrock and Amazon Lex, provides employees with a conversational search interface. They ask "what is the leave encashment policy?" in natural language and receive an answer extracted from the relevant policy, reducing repetitive HR queries and making the policy library genuinely self-service.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">Do AI features cost extra?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">AI feature access is included in the platform, so you're not paying unpredictable per-call fees. The underlying AWS AI service costs (Bedrock, Polly, Translate) are factored into the platform pricing model. AI features are not gated add-ons that require a premium tier upgrade; they are core to what differentiates PolicyCentral.ai from generic document management tools.</div></div></div>
    </div>

    <div class="other-cats">
      <h3>Explore other FAQ categories</h3>
      <div class="other-grid">
        <a href="<?php echo esc_url(home_url('/faq/company-platform/')); ?>" class="other-link"><span class="oi">🏢</span>Company &amp; Platform</a>
        <a href="<?php echo esc_url(home_url('/faq/features-dashboard/')); ?>" class="other-link"><span class="oi">⚙️</span>Features &amp; Dashboard</a>
        <a href="<?php echo esc_url(home_url('/faq/compliance-tracking/')); ?>" class="other-link"><span class="oi">✅</span>Compliance &amp; Tracking</a>
        <a href="<?php echo esc_url(home_url('/faq/publishing/')); ?>" class="other-link"><span class="oi">📢</span>Publishing &amp; Distribution</a>
        <a href="<?php echo esc_url(home_url('/faq/hosting-security/')); ?>" class="other-link"><span class="oi">🔒</span>Hosting &amp; Security</a>
        <a href="<?php echo esc_url(home_url('/faq/implementation/')); ?>" class="other-link"><span class="oi">🚀</span>Implementation &amp; Integration</a>
        <a href="<?php echo esc_url(home_url('/faq/roi-business/')); ?>" class="other-link"><span class="oi">📈</span>ROI &amp; Business Case</a>
        <a href="<?php echo esc_url(home_url('/faq/it-ciso/')); ?>" class="other-link"><span class="oi">🛡️</span>IT &amp; CISO</a>
        <a href="<?php echo esc_url(home_url('/faq/pricing-finance/')); ?>" class="other-link"><span class="oi">💰</span>Pricing &amp; Finance FAQs</a>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>

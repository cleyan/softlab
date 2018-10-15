<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="resultados" dataSource="resultados" errorSummator="Error" wizardCaption="Agregar/Editar Resultados " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" returnPage="closeandrefresh.ccp" PathID="resultados">
			<Components>
				<Label id="33" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="style_list_valor" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ListBox id="25" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" editable="True" hasErrorCollection="True" returnValueType="Number" name="list_valor" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="valores_resultado" boundColumn="nom_resultado" textColumn="nom_resultado" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_resultado" visible="Yes" PathID="resultadoslist_valor">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="26" conditionType="Parameter" useIsNull="False" field="test_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="test_id" orderNumber="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<Label id="34" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="style_text_valor" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="11" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="valor" required="False" caption="Valor" wizardCaption="Valor" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="resultadosvalor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Label id="35" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="style_textarea_valor" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextArea id="30" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="TextArea_valor" wizardTheme="Inline" wizardThemeType="File" visible="Yes" PathID="resultadosTextArea_valor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Hidden id="6" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="resultado_id" fieldSource="resultado_id" required="False" caption="Id" wizardCaption="Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resultadosresultado_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="7" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="peticion_id" fieldSource="peticion_id" required="False" caption="Peticion Id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resultadospeticion_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="8" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="test_id" fieldSource="test_id" required="False" caption="Test Id" wizardCaption="Test Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resultadostest_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="9" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="muestra_id" fieldSource="muestra_id" required="False" caption="Muestra Id" wizardCaption="Muestra Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resultadosmuestra_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="10" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="estado_id" fieldSource="estado_id" required="False" caption="Estado Id" wizardCaption="Estado Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" defaultValue="10" PathID="resultadosestado_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="14" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="hora_creacion" fieldSource="hora_creacion" required="False" caption="Hora Creacion" wizardCaption="Hora Creacion" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" defaultValue="GetFechaServer('server_hora')" PathID="resultadoshora_creacion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="12" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="fecha_creacion" fieldSource="fecha_creacion" required="False" caption="Fecha Creacion" wizardCaption="Fecha Creacion" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" defaultValue="GetFechaServer(server)" PathID="resultadosfecha_creacion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="21" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="ingresado_por" fieldSource="ingresado_por" required="False" caption="Ingresado Por" wizardCaption="Ingresado Por" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" defaultValue="CCGetUserID()" PathID="resultadosingresado_por">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="23" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="pagina" wizardTheme="Inline" wizardThemeType="File" PathID="resultadospagina">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="32" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="hidden_valor" wizardTheme="Inline" wizardThemeType="File" fieldSource="valor" required="True" caption="Nuevo resultado" PathID="resultadoshidden_valor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Agregar" PathID="resultadosButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="4" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Cancelar" PathID="resultadosButton_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="27"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="5" conditionType="Parameter" useIsNull="False" field="resultado_id" parameterSource="resultado_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="add_nuevo_resultado.php" comment="//" codePage="utf-8" forShow="True" url="add_nuevo_resultado.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="add_nuevo_resultado_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="36"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
